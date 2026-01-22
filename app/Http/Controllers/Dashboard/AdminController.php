<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('store')
            ->filter(request()->only('status', 'name'))
            ->paginate(10);
        return view('dashboard.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = new Admin();
        $stores = Store::pluck('name', 'id');
        return view('dashboard.admins.store', [
            'admin' => $admin,
            'stores' => $stores,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
        return redirect()->route('admins.index')->with('success', "Admin Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {

        $stores = Store::pluck('name', 'id');
        return view('dashboard.admins.edit', [
            'admin' => $admin,
            'stores' => $stores,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:admins,email,' . $id,
            'phone_number' => 'sometimes|string|max:20',
            'store_id' => 'sometimes|exists:stores,id',
            'username'     => 'sometimes|string|max:255|unique:admins,username,' . $id,
            'status'       => 'sometimes|in:active,inactive',
            'super_admin' => 'sometimes|boolean',
        ]);
        $admin = Admin::findOrFail($id);
        $admin->update($data);
        return redirect()->route('admins.index')->with('update', "Admin Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('delete', "Admin Deleted Successfully");
    }
}
