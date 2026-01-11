<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class Order extends Model
{

    protected $guarded = [];
    protected static function booted()
    {
        static::creating(function (Order $order) {
            $order->number = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        $year = now()->year;
        $lastNumber = Order::whereYear('created_at', $year)
            ->max('number');
        if ($lastNumber) {
            $sequence = (int) substr($lastNumber, 4); // آخر 4 أرقام
            $sequence++;
        } else {
            $sequence = 1;
        }
        return $year . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)
            ->withDefault([
                'name' => 'Guest'
            ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->using(OrderItem::class)
            ->as('order_item') // name of pivot and called in Deducted product Quantity
            ->withPivot(['product_name', 'price', 'quantity', 'options']);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }

}
