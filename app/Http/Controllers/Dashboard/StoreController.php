<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('index', Store::class);
        $stores = Store::filter($request->query())->where('id','!=', 8)->paginate(10);
        return view('dashboard.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Store::class);
        return view('Dashboard.Stores.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Store::class);

        $data = $request->validated();
        $data['slug'] = Str::slug($request->name);
        $logo = $this->uploadImage($request, 'logo_image');
        $cover = $this->uploadImage($request, 'cover_image');
        if ($logo) {
            $data['logo_image'] = $logo;
        };
        if ($cover) {
            $data['cover_image'] = $cover;
        };

        Store::create($data);
        return redirect()->route('stores.index')
            ->with('success', 'Store Add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', Store::class);

        $store = Store::withCount('products as product_num')
            ->findOrFail($id);
        return view('Dashboard.Stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update', Store::class);

        $store = Store::findorfail($id);
        return view('Dashboard.Stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('update', Store::class);

        $store = Store::findorfail($id);
        $old_logo = $store->logo_image;
        $old_cover = $store->cover_image;
        $data = $request->except('logo_image', 'cover_image');
        $logo_path = $this->uploadImage($request, 'logo_image');
        $cover_path = $this->uploadImage($request, 'cover_image');

        if ($logo_path) {
            $data['logo_image'] = $logo_path;
        }
        if ($cover_path) {
            $data['cover_image'] = $cover_path;
        }
        $store->update($data);
        if ($logo_path && $old_logo) {
            Storage::disk('public')->delete($old_logo);
        }
        if ($cover_path && $old_cover) {
            Storage::disk('public')->delete($old_cover);
        }
        return redirect()->route('stores.index')
            ->with('success', 'Store Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Store::class);

        $store = Store::findorfail($id);
        $store->delete();
        return redirect()->route('stores.index')
            ->with('delete', 'Store Delete Succesfully!');
    }

    public function showTrashed(Request $request)
    {
        $stores = Store::onlyTrashed()->filter($request->query())->paginate(10);
        return view('dashboard.stores.trash', compact('stores'));
    }

    public function restore($id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->restore();
        return redirect()->route('stores.index')
            ->with('success', 'Store Restored Successfully');
    }

    public function forceDelete($id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->forceDelete();
        if ($store->cover_image) {
            Storage::disk('public')->delete($store->cover_image);
        }
        if ($store->logo_image) {
            Storage::disk('public')->delete($store->logo_image);
        }
        return redirect()->route('stores.index')
            ->with('delete', 'Store deleted Successfully');
    }




    protected function uploadImage(Request $request, $image)
    {
        if (!$request->hasFile($image)) {
            return null;
        }
        $path = $request->file($image)->store('uploads', 'public');
        return $path;
    }
}
