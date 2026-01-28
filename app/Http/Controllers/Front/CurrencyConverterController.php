<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|string|max:3',
        ]);

        $currency_to = $request->post('currency_code');
        $currency_from =  config('app.currency', 'EGP');
        Session::put('currency_code', $currency_to);

        $rateKey = "currency_rate_{$currency_to}"; // currency_rate_EUR
        $currency_rate = Cache::get($rateKey, 0); // value in cache named currency_rate_EUR and = 47.2791 

        if (!Cache::has($rateKey)) { // if cache not has currency_rate_EUR
            $converter = new CurrencyConverter;
            $currency_rate = $converter->format($currency_from, $currency_to); // currency_rate_EUR == 47.2791
            Cache::put($rateKey, $currency_rate, now()->addMinutes(60));;
        };
        // @dd($currency_from, $currency_to);
        // Session::put('currency_rate', $currency_rate);
        return redirect()->back();
    }
}
