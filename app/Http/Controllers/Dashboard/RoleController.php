<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);
        $roles = role::paginate();
        return view('dashboard.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        return view('dashboard.roles.create', [
            'role' => new role(),
            'role_ability' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        role::createWithAbilities($request);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        $this->authorize('update', Role::class);
        $role_ability = $role->abilities->pluck('type', 'ability')->toArray();
        return view('dashboard.roles.edit', compact('role', 'role_ability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, role $role)
    {
        $this->authorize('update', Role::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
        ]);
        // Update role 
        $role->updateWithAbilities($request);
        return redirect()->route('roles.index')->with('update', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', Role::class);
        role::destroy($id);
        return redirect()->route('roles.index')->with('delete', 'Role deleted successfully.');
    }
}
