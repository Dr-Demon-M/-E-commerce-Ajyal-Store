<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'method',
        'status',
        'provider_reference',
        'transaction_data',
    ];

    protected $casts = [ // Cast transaction_data to an array for easy access
        'transaction_data' => 'json',
    ];
}
