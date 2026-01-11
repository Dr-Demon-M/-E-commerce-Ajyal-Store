<?php

namespace App\Models;

use App\Models\Scopes\CartScope;
use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];

    protected static function booted()
    {
        static::observe(CartObserver::class);

        static::addGlobalScope('Cookie_id', new CartScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Anonymous'
        ]);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getCookie()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id =  Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }
}
