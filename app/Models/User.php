<?php

namespace App\Models;

use App\Concerns\HasRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements MustVerifyEmail // add this for mail verification
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasApiTokens, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'two_factor_confirmed_at',
        'two_factor_recovery_codes',
        'two_factor_secret'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_active' => 'datetime',
        ];
    }

    public function ScopeFilter(Builder $builder, $Filters)
    {
        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->where('Users.name', 'LIKE', "%{$value}%");
        });
        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->orWhere('Users.email', 'LIKE', "$value");
        });
    }
}
