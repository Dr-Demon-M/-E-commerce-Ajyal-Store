<?php

namespace App\Concerns;

use App\Models\role;

trait HasRole
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }

    public function hasAbilities($Ability)
    {
        return $this->roles()->whereHas('abilities', function ($query) use ($Ability) {
            $query->where('ability', $Ability)
                ->where('type', 'allow');
        })->exists();
    }
}
