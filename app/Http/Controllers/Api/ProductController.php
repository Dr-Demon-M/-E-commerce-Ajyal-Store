<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::apiFilter($request->query())->get();
        return response()->json(ProductResource::collection($products), 201)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // بدلاً من auth()->user()->id مباشرة
        $storeId = auth()->user()?->store_id;

        if (!$storeId) {
            return response()->json(['message' => 'This user does not belong to a store'], 403);
        }
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'status'        => 'in:active,inactive',
            'price'         => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);
        $data['store_id'] = $storeId;

        $product = Product::create($data);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json(new ProductResource($product), 201)
            ->setEncodingOptions(JSON_PRETTY_PRINT);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($product->store_id !== auth()->user()->store_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $data = $request->validate([
            'name'          => 'sometimes|required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'category_id'   => 'sometimes|required|exists:categories,id',
            'status'        => 'in:active,inactive',
            'price'         => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
        ]);

        $product->update($data);
        return response()->json($product, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $storeId = Auth::user()->store_id;
        if (! $storeId) {
            return response()->json(['message' => 'This user does not belong to a store'], 403);
        }
        $product = Product::where('store_id', $storeId)->find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Product not found or you do not have permission to delete it.'
            ], 404);
        }
        $product->forceDelete();

        return response()->json([
            'message' => 'Product Deleted Successfully.'
        ], 200);
    }
}
