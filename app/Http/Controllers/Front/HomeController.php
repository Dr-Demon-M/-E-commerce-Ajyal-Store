<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $trending = Product::with('category')->where('show_in_home', 'trending')->take(8)->get();
        $slider = Product::with('category')->where('show_in_home', 'slider  ')->take(3)->get();
        $new = Product::with('category')->where('show_in_home', 'small-banner')->take(2)->get();
        $largeBanner = Product::with('category')->where('show_in_home', 'banner')->take(2)->get();
        $bestOffer = Product::whereNotNull('compare_price')->orderByRaw('(compare_price - price) DESC')->take(3)->get();
        $specialCard = Product::with('category')->where('show_in_home', 'special')->first();
        $specialCard2 = Product::with('category')->where('status', 'active')->inRandomOrder()->first();
        $brandImage = Store::all();
        $bestSellers = Product::select('name', 'product_image', 'slug', 'price') // select 4 row from table
            ->withCount('orderItems') // Calculate the number of order items associated with each product (From relations)
            ->orderByDesc('order_items_count') // order descending
            ->take(3)
            ->get();
        $newArrival = Product::orderByDesc('created_at')->take(3)->get();
        $topRated = Product::orderByDesc('rate')->take(3)->get();
        return view('Front.home', compact(
            'trending',
            'slider',
            'new',
            'largeBanner',
            'bestOffer',
            'specialCard',
            'specialCard2',
            'brandImage',
            'bestSellers',
            'newArrival',
            'topRated'
        ));
    }
}
