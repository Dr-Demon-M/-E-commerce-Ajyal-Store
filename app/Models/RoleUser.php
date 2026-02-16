<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    public $incrementing = false;
    protected $primaryKey = null;
    protected $keyType = 'string'; // لأن فيه string ضمن المفتاح
    protected $fillable = [
        'authorizable_id',
        'authorizable_type',
        'role_id',
    ];
}
