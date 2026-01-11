<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'store_id',
        'category_id',
        'product_image',
        'slug',
        'description',
        'price',
        'options',
        'rate',
        'featured',
        'status',
        'show_in_home',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'show_in_home',
        'product_image'
    ];

    protected $appends = [
        'image_url'
    ];

    // Scopes
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope); // to make global scope and StoreScope for function

        static::creating(function (Product $product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function scopeFilter(Builder $builder, $Filters) // to make local scope called when write ->filter()
    {
        // if ($Filters['name'] ?? false) {
        //     $builder->where('name', 'LIKE', "%{$Filters['name']}%");
        // };
        // // Where == And // it seems like say query->where and query->where
        // if ($Filters['status'] ?? false) {
        //     $builder->where('status', '=', $Filters['status']);
        // };

        $builder->when($Filters['name'] ?? false, function ($builder, $value) {
            $builder->where('products.name', 'LIKE', "%{$value}%");
        });
        $builder->when($Filters['status'] ?? false, function ($builder, $value) {
            $builder->where('products.status', '=', "{$value}");
        });
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }

    public function scopeApiFilter(Builder $builder, $Filters)
    {
        $options = array_merge([
            'status' => null,
            'category_id' => null,
            'store_id' => null,
            'tag_id' => null
        ], $Filters);

        $builder->when($options['status'], function ($builder, $value) {
            $builder->where('status', $value);
        });

        $builder->when($options['category_id'], function ($builder, $value) {
            $builder->where('category_id', $value);
        });

        $builder->when($options['store_id'], function ($builder, $value) {
            $builder->where('store_id', $value);
        });

        $builder->when($options['tag_id'], function ($builder, $value) {
            $builder->whereHas('tags', function ($query) use ($value) {
                $query->where('tags.id', $value);
            });
        });
    }
    // Relation 

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tag_id',
            'id',
            'id'
        );
    }

    public function getImageUrlAttribute()
    {
        if (!$this->product_image) {
            return 'https://ui-avatars.com/api/?name=' .  $this->name . '&background=f8f9fa&color=6c757d?format=svg';
        }
        if (Str::startsWith($this->product_image, ['https://', 'http://'])) {
            return $this->image;
        }
        return asset('storage/' . $this->product_image);
    }

    public function getSalePercentAttribute()
    {
        if (!$this->compare_price) {
            return 0;
        }
        return round(100 - (100 * ($this->price / $this->compare_price)), 0);
    }
}
