<?php

namespace App\Services;

use App\Models\coupon;


class CouponService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $code = '';
    }

    public function apply(?string $code)
    {

        if (! $code) {
            session()->forget(['coupon', 'discount']);
            return 0;
        }

        $coupon = Coupon::where('name', $code)->first();

        if (! $coupon) {
            session()->forget(['coupon', 'discount']);
            return 0;
        }

        session([
            'coupon'   => $coupon->name,
            'discount' => $coupon->value,
        ]);

        return $coupon->value;
    }
}
