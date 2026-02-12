<?php

namespace App\Http\Controllers\front;

use App\Events\OrderCreated;
use App\Exceptions\CheckOutException;
use App\Http\Controllers\Controller;
use App\Models\coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CartRepositoryInterface;
use App\Services\CheckoutService;
use App\Services\CouponService;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Config\Exception\ValidationException;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart, Request $request, CouponService $couponService, LocationService $locationService)
    {

        $discount = 0;

        if (session()->has('coupon_code')) {
            $discount = $couponService->apply(
                session('coupon_code'),
                $cart,
                auth()->user()
            );
        }
        $cities = $locationService->cities();
        $governorate = $locationService->governorates();

        if ($cart->get()->isEmpty()) {
            throw new CheckOutException('Cart is empty');
        }

        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
            'cities' => $cities,
            'governorate' => $governorate,
            'request' => $request,
            'discount' => $discount,
        ]);
    }

    public function store(Request $request, CartRepositoryInterface $cart, CheckoutService $checkoutService)
    {
        $request->validate([]);
        $orders = $checkoutService->createOrders($request, $cart);

        /**
         * COD → finalize immediately
         * Stripe → redirect to payment
         */
        if ($request->payment_method === 'Cod') {
            foreach ($orders as $order) {
                $order->update(['payment_status' => 'Pending']);
                event(new OrderCreated($order));
            }
            $cart->empty();
            session()->forget(['coupon', 'discount']);
            return redirect()->route('user.orders.index')->with('success', 'Order placed successfully');
        }

        // Stripe flow
        return redirect()->route('stripe.checkout', [
            'orders' => collect($orders)->pluck('id')->implode(','),
        ]);
    }

    public function applyCoupon(Request $request, CouponService $couponService, CartRepositoryInterface $cart)
    {
        $request->validate([
            'coupon' => ['required', 'string'],
        ]);
        $coupon = Coupon::where('name', $request->coupon)->first();
        if (! $coupon) {
            session()->forget(['coupon_code', 'discount']);
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon',
            ], 422);
        }
        try {
            $discount = $couponService->apply(
                $request->coupon,
                $cart,
                auth()->user()
            );
            session(['coupon_code' => $request->coupon]);
            $total = max(0, $cart->total() - $discount);

            return response()->json([
                'success'        => true,
                'discount_raw'  => $discount,
                'total_raw'     => $total,
                'discount'      => currency($discount),
                'total'         => currency($total),
            ]);
        } catch (ValidationException $e) {
            session()->forget(['coupon_code', 'discount']);
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon',
            ], 422);
        } catch (\Throwable $e) {
            session()->forget(['coupon_code', 'discount']);
            report($e);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please try again',
            ], 500);
        }
    }
}
