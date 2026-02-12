<?php

namespace App\Services;

use App\Exceptions\CheckOutException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createOrders($request, CartRepositoryInterface $cart): array
    {
        if ($cart->get()->isEmpty()) {
            throw new CheckOutException('Cart is empty');
        }

        return DB::transaction(function () use ($request, $cart) {

            $orders = [];
            $groups = $cart->get()->groupBy('product.store_id');

            foreach ($groups as $storeId => $items) {
                $orders[] = $this->createOrderForStore(
                    $storeId,
                    $items,
                    $request
                );
            }

            session()->forget(['coupon', 'discount']);

            return $orders;
        });
    }

    protected function createOrderForStore($storeId, $items, $request): Order
    {
        $order = Order::create([
            'store_id' => $storeId,
            'user_id' => auth()->id(),
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'discount' => session('discount', 0),
        ]);

        $subtotal = 0;

        foreach ($items as $item) {
            $this->createOrderItem($order, $item);
            $subtotal += $item->product->price * $item->quantity;
        }

        $order->update([
            'total' => max(0, $subtotal - session('discount', 0)),
        ]);

        $this->attachAddresses($order, $request);

        return $order;
    }

    protected function createOrderItem(Order $order, $item): void
    {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product->id,
            'product_name' => $item->product->name,
            'price' => $item->product->price,
            'quantity' => $item->quantity,
        ]);
    }

    protected function attachAddresses(Order $order, $request): void
    {
        $addresses = $request->address;

        if ($request->boolean('same_address')) {
            $addresses['shipping'] = $addresses['billing'];
        }

        foreach ($addresses as $type => $address) {
            $order->addresses()->create(
                array_merge($address, ['type' => $type])
            );
        }
    }

    
}
