<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
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
    public function index()
    {
        $cart = $this->cart->get();
        $total = $this->cart->total();
        return view('front.cart', [
            'cart' => $cart,
            'total' => $total,
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
        return redirect()->route('cart.index');
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
}
