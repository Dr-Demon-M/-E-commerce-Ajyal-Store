<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() // for all products page
    {}

    public function show(Product $product) // for single product
    {

        return view('Front.Products.show',compact('product'));
    }
}
