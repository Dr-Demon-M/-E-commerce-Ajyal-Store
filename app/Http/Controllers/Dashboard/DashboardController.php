<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Actions 
    public function index()
    {
        $user = Auth::user();

        $orderQuery = Order::with('products', 'shippingAddress');
        if ($user && $user->store_id) {
            $orderQuery = $orderQuery->where('store_id', $user->store_id);
        }

        $lastOrders = $orderQuery->latest()->take(5)->get(); //
        $total_orders = $orderQuery->count(); //
        $total_incomes = $orderQuery->where('status', 'completed')->sum('total'); //
        $active_products = Product::where('status', 'active')->count(); // 
        $stock_product = Product::where('quantity', '<', '10')->latest()->take(4)->get();

        return view(
            'Dashboard.dashboard1',
            compact(
                'lastOrders',
                'total_orders',
                'total_incomes',
                'active_products',
                'stock_product'
            )
        );
    }
}
