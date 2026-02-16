<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug, Request $request) // for all products page
    {
        $categories = Category::all();
        $stores = Store::where('id','!=',8)->get();
        $products = Category::where('slug', $slug)->firstOrFail()->products()->paginate(10);
        $category = Category::where('slug', $slug)->firstOrFail();

        $query = $category->products();
        if ($request->filled('brands')) {
            $query->whereIn('store_id', $request->brands);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
        
        $products = $query->filter($request)->paginate(10)->withQueryString();
        return view('Front.product-list', compact('products', 'categories', 'stores'));
    }

    public function show(Product $product) // for single product
    {
        return view('Front.Products.show', compact('product'));
    }

    public function allProduct(Request $request) // for all products page
    {
        $categories = Category::all();
        $stores = Store::all();

        $query = Product::query();

        if ($request->filled('brands')) {
            $query->whereIn('store_id', $request->brands);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->filter($request)->paginate(10)->withQueryString();

        return view('Front.all-products-list', compact('products', 'categories', 'stores'));
    }
}
