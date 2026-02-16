<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class role extends Model
{
    protected $fillable = ['name'];

    public function abilities()
    {
        return $this->hasMany(RoleAbility::class);
    }

    public function admins()
    {
        return $this->morphedByMany(Admin::class, 'authorizable', 'role_user');
    }

    public static function createWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = role::create([
                'name' => $request->name,
            ]);

            foreach ($request->abilities as $ability_code => $ability_type) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability_code,
                    'type' => $ability_type,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $role;
    }

    public function updateWithAbilities(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->name,
            ]);
            // Update role abilities
            $abilities = $request->abilities;
            foreach ($abilities as $ability_code => $ability_type) {
                RoleAbility::updateOrCreate([
                    'role_id' => $this->id,
                    'ability' => $ability_code
                ], [
                    'type' => $ability_type,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this;
    }
}
