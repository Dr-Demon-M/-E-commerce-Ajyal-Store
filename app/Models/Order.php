<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Countries;

class Order extends Model
{

    protected $guarded = [];
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope);
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

    // Relations
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


    // Badge Colour
    public function StatusBadgeClass(): string
    {
        return match ($this->status) {
            'pending' => 'bg-warning text-dark',     // Pending = أصفر
            'processing' => 'bg-primary text-white', // Processing = أزرق
            'delivering' => 'bg-info text-white',    // Delivering = سماوي
            'completed' => 'bg-success text-white',  // Completed = أخضر
            'cancelled' => 'bg-danger text-white',   // Cancelled = أحمر
            'refunded' => 'bg-secondary text-white', // Refunded = رمادي
            default => '',
        };
    }
    public function paymentColor(): string
    {
        return match ($this->payment_status) {
            'pending' => 'text-warning',
            'paid' => 'text-success',
            'failed' => 'text-danger',
            default => '',
        };
    }


    // Scopes
    public function scopeFilter(Builder $builder, $Filters)
    {
        $builder->when($Filters['name'] ?? null, function ($builder, $value) {
            $builder->whereHas('shippingAddress', function ($builder) use ($value) {
                $builder->where('first_name', 'Like', "%$value%")
                    ->orWhere('last_name', 'Like', "%$value%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$value}%"])
                    ->orWhereRaw("CONCAT(first_name, last_name) LIKE ?", ["%{$value}%"]);
            });
        });

        $builder->when($Filters['status'] ?? null, function ($builder, $value) {
            $builder->where('status', $value);
        });
    }
}
