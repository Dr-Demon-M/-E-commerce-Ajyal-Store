<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    protected $api_key;
    protected $baseUrl = "https://v6.exchangerate-api.com/v6/";

    public function __construct()
    {
        $this->api_key = config('services.currency.app_key');
    }

    public function format($from, $to)
    {
        $response = Http::get($this->baseUrl . $this->api_key . "/pair/{$from}/{$to}");
        $data = $response->json();
        return $data['conversion_rate'];
    }
}
