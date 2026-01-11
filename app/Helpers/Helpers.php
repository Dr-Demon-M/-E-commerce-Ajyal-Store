<?php

use App\Helpers\Currency;

if (! function_exists('Currency')) {
    function currency($amount, $currency = null)
    {
        return Currency::format($amount, $currency);
    }
}
