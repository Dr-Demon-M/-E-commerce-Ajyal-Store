<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public $options;
    public function __construct()
    {
        $this->options = [
            'slider' => 'Main Slider',
            'small-banner' => 'Small Banner',
            'banner' => 'Large Banner',
            'trending' => 'Trending Section',
            'special' => 'Special Offer',
            'best' => 'Best Sellers',
            'new' => 'New Arrivals',
            'top' => 'Top Rated',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('category', 'store')
            ->filter($request->query())
            ->paginate(20);
        return view('Dashboard.Products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $categories = Category::all();
        $stores = Store::all();
        return view('Dashboard.Products.create', compact('product', 'stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $path = $this->uploadImage($request);
        $data['product_image'] = $path;
        $name = $request['name'];
        $data['slug'] = Str::slug($name);
        Product::create($data);
        return redirect()->route('products.index')
            ->with('success', 'product Added Succefully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('Dashboard.Products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $stores = Store::all();
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        $options = $this->options;
        return view('Dashboard.Products.edit', compact('product', 'categories', 'stores', 'tags', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->except('tags', 'product_image');
        if ($request->hasFile('product_image')) {
            $data['product_image'] = $this->uploadImage($request);
        }
        if ($product->product_image && $request->hasFile('product_image')) {
            Storage::disk('public')->delete($product->product_image);
        }
        $product->update($data);


        // $tags = explode(',', $request->post('tags')); // عامل كدا علشان احوله ل array

        $tags = json_decode($request->post('tags')); // بفك جيسون لاني بستقبل من تاجيفاي جيسون 
        $tag_id = [];
        $saved_tags = Tag::all();
        if (!$tags == null) {
            foreach ($tags as $name) { // بيرجع اوبجيكت جواها بروبيرتي اسمها value
                $slug = Str::slug($name->value);
                $tag = $saved_tags->where('slug', '=', $slug)->First(); // دي مش جملة استعلام دي جملة بحث
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $name->value,
                        'slug' => $slug
                    ]);
                }
                $tag_id[] = $tag->id; // push id 
            }
        }


        $product->tags()->sync($tag_id);
        return redirect()->route('products.index')
            ->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findorfail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('delete', 'Product Deleted Successfully');
    }


    public function showTrashed(Request $request)
    {
        $products = Product::onlyTrashed()->Filter($request->query())->paginate(5);
        return view('dashboard.products.trash', compact('products'));
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        return redirect()->route('products.index')
            ->with('success', 'Product Restored!');
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect()->route('products.trash')
            ->with('delete', 'Product Deleted Successfully !! ');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('product_image')) {
            return;
        };
        $file = $request->file('product_image');
        $path = $file->store('uploads', 'public');
        return $path;
    }
}
