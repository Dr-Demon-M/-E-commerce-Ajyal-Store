<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Nike',
                'description' => 'Global sportswear brand known for running shoes, basketball shoes, and training apparel.',
                'status' => 'active',
            ],
            [
                'name' => 'Adidas',
                'description' => 'Sportswear brand offering performance and lifestyle footwear including running and football boots.',
                'status' => 'active',
            ],
            [
                'name' => 'Puma',
                'description' => 'Athletic and casual footwear brand with strong lines in football and lifestyle sneakers.',
                'status' => 'active',
            ],
            [
                'name' => 'New Balance',
                'description' => 'Footwear brand well-known for running shoes, comfort-focused sneakers, and classic silhouettes.',
                'status' => 'active',
            ],
            [
                'name' => 'Vans',
                'description' => 'Iconic skate and streetwear footwear brand famous for Old Skool and Slip-On styles.',
                'status' => 'active',
            ],
        ];

        foreach ($stores as $item) {
            Store::create([
                'name'        => $item['name'],
                'slug'        => Str::slug($item['name']),
                'description' => $item['description'],
                'logo_image'  => null, // هتحطها انت بعدين
                'cover_image' => null, // هتحطها انت بعدين
                'status'      => $item['status'], // enum: active/inactive
            ]);
        }
    }
}
