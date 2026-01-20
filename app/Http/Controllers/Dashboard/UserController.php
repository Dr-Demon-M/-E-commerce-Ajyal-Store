<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::filter($request->only('name'))->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        return view('dashboard.users.store', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->validated();
        // $data['password'] = Hash::make($data['password']);
        // User::create($data);
        // return redirect()->route('users.index')->with('success', "User Added Successfully");
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
    public function edit(User $user)
    {

        return view('dashboard.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $data = $request->validate([
        //     'name' => 'sometimes|string|max:255',
        //     'email' => 'sometimes|email|unique:users,email,' . $id,
        //     'phone_number' => 'sometimes|string|max:20',
        //     'store_id' => 'sometimes|exists:stores,id',
        //     'username'     => 'sometimes|string|max:255|unique:users,username,' . $id,
        //     'status'       => 'sometimes|in:active,inactive',
        // ]);
        // $user = User::findOrFail($id);
        // $user->update($data);
        // return redirect()->route('users.index')->with('update', "User Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('delete', "User Deleted Successfully");
    }
}
