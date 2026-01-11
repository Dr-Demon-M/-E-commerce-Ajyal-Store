<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'name',
        'status',
        'description',
        'logo_image',
        'cover_image',
        'slug'
    ];

    // Relations

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function ScopeFilter(Builder $builder, $Filters)
    {
        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name','LIKE',"%{$value}%");
        });
        $builder->when($Filters['status'] ?? false, function ($builder, $value) {
            $builder->where('status','=',$value);
        });
        
    }
}
