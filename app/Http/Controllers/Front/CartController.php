<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Currency;
use App\Http\Controllers\Controller;
use App\Models\coupon;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartRepositoryInterface $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, CouponService $couponService)
    {
        $cart = $this->cart->get();
        $total = $this->cart->total();
        $discount = 0;

        if (session()->has('coupon_code')) {
            try {
                $discount = $couponService->apply(
                    session('coupon_code'),
                    $cart,
                    auth()->user()
                );
            } catch (\Throwable $e) {
                session()->forget('coupon_code');
                $discount = 0;
            }
        }

        // $total = $cart->total();
        return view('front.cart', [
            'cart' => $cart,
            'total' => $total,
            'discount' => $discount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $this->cart->add($product, $quantity);
        return redirect()->back()->with('success-order', 'Product Added to Cart Successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);
        $quantity = $request->quantity;
        $this->cart->update($id, $quantity);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart'
        ]);

        return redirect()->route('home');
    }

    public function checkoutSuccess()
    {
        $this->cart->empty();
        session()->forget(['coupon_code']);
        return redirect()->route('user.orders.index')->with('success', 'Your order has been placed successfully!');
    }
}
