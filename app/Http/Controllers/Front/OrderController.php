<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->paginate(10);
        return view('Front.orders.user-orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('products', 'shippingAddress')->find($id);
        return view('Front.orders.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cancel(Order $order)
    {
        if ($order->status == 'pending') {
            $order->status = 'cancelled';
            $order->save();

            foreach ($order->products as $product) {
                $product->quantity += $product->order_item->quantity;
                $product->save();
            }

            return redirect()->route('user.orders.index')->with('error', 'Order canceled successfully.');
        }

        return redirect()->route('user.orders.index')->with('error', 'Only pending orders can be canceled.');
    }
}
