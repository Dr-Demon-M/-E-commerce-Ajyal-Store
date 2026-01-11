<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = Product::with('category')->where('show_in_home', 'trending')->take(8)->get();
        $slider = Product::with('category')->where('show_in_home', 'slider  ')->take(3)->get();
        return view('Front.home', compact('products','slider'));
    }
}
