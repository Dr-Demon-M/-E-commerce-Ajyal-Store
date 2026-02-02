<?php

namespace App\Models;

use App\Concerns\HasRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User implements MustVerifyEmail
{
    use Notifiable, HasFactory, HasApiTokens, HasRole;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'super_admin',
        'status',
        'store_id',
    ];

    protected $hidden = [
        'password',
        'updated_at',
        'created_at',
        'super_admin',
        'id'
    ];

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id'); // relation with store which store.id = admin.store_id
    }

    public  function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id')
            ->withDefault();
    }

    public function ScopeFilter(Builder $builder, $Filters)
    {
        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->where('admins.name', 'LIKE', "%{$value}%");
        });
        $builder->when($Filters['status'] ?? false, function ($builder, $value) {
            $builder->where('admins.status', '=', "$value");
        });
    }
}
