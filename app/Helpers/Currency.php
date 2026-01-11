<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use NumberFormatter;

class Currency
{
    // rate in cache named {currency_rate_EUR} and currency in session {currency_code}
    public static function format($amount, $currency = null)
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        $baseCurrency = config('app.currency', 'USD');
        if ($currency === null) {
            $currency = Session::get('currency_code', $baseCurrency);
        }

        $rate = Cache::get('currency_rate_' . $currency, 1); // currency_rate_EUR
        
        if ($currency !== $baseCurrency) {
            $amount = $amount * $rate;
        }


        return $formatter->formatCurrency($amount, $currency);
    }
}
