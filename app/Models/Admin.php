<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    Use Notifiable, HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'super_admin',
        'status'
    ];

    protected $hidden = [
        'password',
        'updated_at',
        'created_at',
        'super_admin',
        'id'
    ];
}
