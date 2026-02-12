<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class LocationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function cities()
    {
        return Cache::rememberForever('cities', function () {
            $json = json_decode(
                file_get_contents(storage_path('app/data/cities.json')),
                true
            );

            $data = collect($json)->firstWhere('type', 'table')['data'];
            return collect($data)->pluck('city_name_en')->sort()->values();
        });
    }

    public function governorates()
    {
        return Cache::rememberForever('governorates', function () {
            $json = json_decode(
                file_get_contents(storage_path('app/data/governorates.json')),
                true
            );

            $data = collect($json)->firstWhere('type', 'table')['data'];
            return collect($data)->pluck('governorate_name_en')->sort()->values();
        });
    }
}
