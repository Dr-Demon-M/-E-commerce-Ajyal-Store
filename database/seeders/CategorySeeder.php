<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Parent Categories
            [
                'parent' => null,
                'name' => 'Sportswear',
                'description' => 'Sports and training apparel, shoes, and accessories.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => null,
                'name' => 'Sneakers',
                'description' => 'Everyday sneakers, streetwear styles, and lifestyle shoes.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => null,
                'name' => 'Running Shoes',
                'description' => 'Performance running shoes for road and trail.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => null,
                'name' => 'Football Boots',
                'description' => 'Football boots for turf, firm ground, and indoor courts.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => null,
                'name' => 'Basketball Shoes',
                'description' => 'High-performance shoes designed for basketball.',
                'status' => 'active',
                'image' => 'null',
            ],

            // Child Categories (under Sneakers)
            [
                'parent' => 'Sneakers',
                'name' => 'Skate Shoes',
                'description' => 'Skateboarding shoes built for grip and durability.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => 'Sneakers',
                'name' => 'Slip-On Shoes',
                'description' => 'Easy slip-on lifestyle shoes for everyday wear.',
                'status' => 'active',
                'image' => 'null',
            ],

            // Child Categories (under Sportswear)
            [
                'parent' => 'Sportswear',
                'name' => 'Training Shoes',
                'description' => 'Shoes built for gym workouts and cross training.',
                'status' => 'active',
                'image' => 'null',
            ],

            // More parents
            [
                'parent' => null,
                'name' => 'Sandals & Slides',
                'description' => 'Casual slides and sandals for comfort and recovery.',
                'status' => 'active',
                'image' => 'null',
            ],
            [
                'parent' => null,
                'name' => 'Hiking Shoes',
                'description' => 'Outdoor footwear designed for trails and hiking.',
                'status' => 'active',
                'image' => 'null',
            ],
        ];

        // Create parents first then children
        $created = [];

        foreach ($categories as $item) {
            $parentId = null;

            if (!empty($item['parent']) && isset($created[$item['parent']])) {
                $parentId = $created[$item['parent']]->id;
            }

            $category = Category::create([
                'parent_id'   => $parentId,
                'name'        => $item['name'],
                'slug'        => Str::slug($item['name']),
                'description' => $item['description'],
                'image'       => null, // optional
                'status'      => $item['status'], // enum: active/archived
            ]);

            $created[$item['name']] = $category;
        }
    }
}
