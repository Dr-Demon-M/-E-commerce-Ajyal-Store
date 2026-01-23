<?php

namespace App\Http\Controllers\front;

use App\Events\OrderCreated;
use App\Exceptions\CheckOutException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepositoryInterface $cart)
    {
        $json = json_decode(
            file_get_contents(storage_path('app/data/cities.json')),
            true
        );
        $allCities = collect($json)->firstWhere('type', 'table')['data'];
        $cities = collect($allCities)->pluck('city_name_en')->sort()->values();

        $json2 = json_decode(
            file_get_contents(storage_path('app/data/governorates.json')),
            true
        );
        $allGover = collect($json2)->firstWhere('type', 'table')['data'];
        $governorate = collect($allGover)->pluck('governorate_name_en')->sort()->values();
        
        if ($cart->get()->isEmpty()) {
            // return redirect()->route('home');
            throw new CheckOutException('Cart is empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
            'cities' => $cities,
            'governorate' => $governorate,
        ]);
    }

    public function store(Request $request, CartRepositoryInterface $cart)
    {
        $request->validate([]);
        $carts = $cart->get()->groupBy('product.store_id')->all();
        DB::beginTransaction();
        try {
            foreach ($carts as $store_id => $cart_item) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);
                $subtotal = 0;
                foreach ($cart_item as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                    $subtotal += ($item->product->price * $item->quantity);
                }
                $order->update([
                    'total' => $subtotal,
                ]);

                foreach ($request->post('address') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
                event(new OrderCreated($order));
            }

            DB::commit();
            $cart->empty();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home');
    }
}
