<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbilities('roles.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Role $role): bool
    {
        return $user->hasAbilities('roles.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbilities('roles.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user): bool
    {
        return $user->hasAbilities('roles.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Role $role): bool
    {
        return $user->hasAbilities('roles.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return false;
    }
}
