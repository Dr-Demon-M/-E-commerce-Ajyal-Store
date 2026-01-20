<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Expr\FuncCall;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'slug',
        'image',
        'status'
    ];

    public function ScopeActive(Builder $builder)
    {
        $builder->where('categories.status', '=', 'active'); // $builder = $query
    }

    public function scopeFilter(Builder $builder, $Filters)
    {
        // if ($Filters['name'] ?? false) {
        //     $builder->where('name', 'LIKE', "%{$Filters['name']}%");
        // };
        // // Where == And // it seems like say query->where and query->where
        // if ($Filters['status'] ?? false) {
        //     $builder->where('status', '=', $Filters['status']);
        // };

        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->where('categories.name', 'LIKE', "%{$value}%");
        });
        $builder->when($Filters['status'] ?? false, function ($builder, $value) {
            $builder->where('categories.status', '=', "{$value}");
        });
    }
    // relations 

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
        ->withDefault(['name' => 'Main Category']);
    }
}
