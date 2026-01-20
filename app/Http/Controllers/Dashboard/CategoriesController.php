<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);
        // $request = $request->query() // get all data from url
        //$query = Category::query(); //  SELECT * FROM categories
        // $categories = $query->paginate(1);


        /* Select * From Categories,
        Select name from parents,
        on parents.parent_id = categories.id */

        $categories = Category::with('parent')
            /*::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/
            ->withCount('products as products_num')

            // ->withCount([
            //     'products as parents_num' => function ($query) {
            //         $query->where('status', '=','active');
            //     }
            // ]) // to get active product num.

            ->filter($request->query()) // scope located in model
            // ->withTrashed()
            ->paginate(5); // to make multi pages

        return view('Dashboard.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        $parents = Category::all();
        $category = new Category(); // علشان يعمل كاتيجوري فاضي اقدر امرره بس 
        return view('Dashboard.Categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create', Category::class);
        /* كود بديل منسق اكتر 
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('uploads', 'public');
        }
        Category::create($data);
        */

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);
        $data['image'] = $this->uploadImage($request); // Instead of repeating the process, all I did was create a function for it and use it here.
        Category::create($data);
        return redirect()->route('categories.index')
            ->with('success', 'Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $this->authorize('view', Category::class);
        $category = Category::findorfail($id);
        $products = $category->products()->filter($request->query())->paginate(10);
        return view('Dashboard.Categories.show', compact('category', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Category::class);

        $category = Category::findorfail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();
        return view('Dashboard.Categories.edit', compact('parents', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->authorize('update', Category::class);

        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('categories.index')
            ->with('update', 'Category Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Category::class);

        $category = Category::findorfail($id);
        $category->delete();
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // }

        // $category->destroy($id);

        return redirect()->route('categories.index')
            ->with('delete', 'Category Deleted Successfully');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('uploads', 'public');
        return $path;
    }

    public function showTrashed(Request $request)
    {
        $categories = Category::onlyTrashed()->Filter($request->query())->paginate(5);
        return view('dashboard.categories.trash', compact('categories'));
    }


    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.index')
            ->with('success', 'Category Restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.trash')
            ->with('delete', 'Category Deleted Successfully');
    }
}
