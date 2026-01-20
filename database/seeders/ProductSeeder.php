<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // لازم تكون Categories و Stores اتزرعوا قبل كده
        $stores = Store::all()->keyBy('name');
        $categories = Category::all()->keyBy('name');

        // Helper: get id safely
        $storeId = fn ($name) => optional($stores->get($name))->id;
        $catId   = fn ($name) => optional($categories->get($name))->id;

        // لو لقيت نقص في بيانات أساسية
        if ($stores->count() < 1 || $categories->count() < 1) {
            $this->command?->warn('Please seed stores and categories before products.');
            return;
        }

        $showInHomeOptions = [null, 'slider', 'small-banner', 'banner', 'trending'];
        $statuses = ['active', 'draft', 'archived'];

        $products = [

            // =========================
            // Running Shoes
            // =========================
            ['store' => 'Nike', 'category' => 'Running Shoes', 'name' => 'Nike Air Zoom Pegasus 40', 'price' => 6499, 'compare_price' => 7299, 'featured' => 1],
            ['store' => 'Nike', 'category' => 'Running Shoes', 'name' => 'Nike ZoomX Vaporfly Next% 3', 'price' => 14999, 'compare_price' => 16999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Running Shoes', 'name' => 'adidas Ultraboost 22', 'price' => 8999, 'compare_price' => 9999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Running Shoes', 'name' => 'adidas Adizero Boston 12', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],
            ['store' => 'New Balance', 'category' => 'Running Shoes', 'name' => 'New Balance Fresh Foam 1080v13', 'price' => 8999, 'compare_price' => 9999, 'featured' => 1],
            ['store' => 'New Balance', 'category' => 'Running Shoes', 'name' => 'New Balance FuelCell Rebel v3', 'price' => 6999, 'compare_price' => 7999, 'featured' => 0],

            // =========================
            // Basketball Shoes
            // =========================
            ['store' => 'Nike', 'category' => 'Basketball Shoes', 'name' => 'Nike LeBron 21', 'price' => 9999, 'compare_price' => 10999, 'featured' => 1],
            ['store' => 'Nike', 'category' => 'Basketball Shoes', 'name' => 'Nike KD 16', 'price' => 8999, 'compare_price' => 9999, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Basketball Shoes', 'name' => 'adidas Harden Vol. 7', 'price' => 8499, 'compare_price' => 9499, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Basketball Shoes', 'name' => 'PUMA MB.03', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],

            // =========================
            // Football Boots
            // =========================
            ['store' => 'Nike', 'category' => 'Football Boots', 'name' => 'Nike Mercurial Vapor 15', 'price' => 8999, 'compare_price' => 9999, 'featured' => 1],
            ['store' => 'Nike', 'category' => 'Football Boots', 'name' => 'Nike Phantom GX 2', 'price' => 9299, 'compare_price' => 10299, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Football Boots', 'name' => 'adidas Predator Accuracy', 'price' => 8999, 'compare_price' => 9999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Football Boots', 'name' => 'adidas X Crazyfast', 'price' => 8999, 'compare_price' => 9999, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Football Boots', 'name' => 'PUMA Future Ultimate', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],

            // =========================
            // Sneakers (Lifestyle)
            // =========================
            ['store' => 'Nike', 'category' => 'Sneakers', 'name' => 'Nike Air Force 1', 'price' => 5499, 'compare_price' => 5999, 'featured' => 1],
            ['store' => 'Nike', 'category' => 'Sneakers', 'name' => 'Nike Dunk Low', 'price' => 5999, 'compare_price' => 6499, 'featured' => 0],
            ['store' => 'Nike', 'category' => 'Sneakers', 'name' => 'Nike Air Max 90', 'price' => 6999, 'compare_price' => 7999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Sneakers', 'name' => 'adidas Samba OG', 'price' => 5499, 'compare_price' => 5999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Sneakers', 'name' => 'adidas Stan Smith', 'price' => 4799, 'compare_price' => 5299, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Sneakers', 'name' => 'PUMA Suede Classic', 'price' => 4299, 'compare_price' => 4799, 'featured' => 0],
            ['store' => 'New Balance', 'category' => 'Sneakers', 'name' => 'New Balance 550', 'price' => 6499, 'compare_price' => 7299, 'featured' => 1],
            ['store' => 'New Balance', 'category' => 'Sneakers', 'name' => 'New Balance 574', 'price' => 4999, 'compare_price' => 5499, 'featured' => 0],

            // =========================
            // Skate Shoes
            // =========================
            ['store' => 'Vans', 'category' => 'Skate Shoes', 'name' => 'Vans Old Skool', 'price' => 3499, 'compare_price' => 3999, 'featured' => 1],
            ['store' => 'Vans', 'category' => 'Skate Shoes', 'name' => 'Vans Sk8-Hi', 'price' => 3999, 'compare_price' => 4499, 'featured' => 0],
            ['store' => 'Vans', 'category' => 'Skate Shoes', 'name' => 'Vans Authentic', 'price' => 2999, 'compare_price' => 3499, 'featured' => 0],

            // =========================
            // Slip-On Shoes
            // =========================
            ['store' => 'Vans', 'category' => 'Slip-On Shoes', 'name' => 'Vans Classic Slip-On', 'price' => 3199, 'compare_price' => 3699, 'featured' => 1],
            ['store' => 'Vans', 'category' => 'Slip-On Shoes', 'name' => 'Vans Checkerboard Slip-On', 'price' => 3399, 'compare_price' => 3899, 'featured' => 0],

            // =========================
            // Training Shoes
            // =========================
            ['store' => 'Nike', 'category' => 'Training Shoes', 'name' => 'Nike Metcon 9', 'price' => 6999, 'compare_price' => 7999, 'featured' => 1],
            ['store' => 'Nike', 'category' => 'Training Shoes', 'name' => 'Nike Free Metcon 5', 'price' => 5999, 'compare_price' => 6999, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Training Shoes', 'name' => 'adidas Dropset Trainer 2', 'price' => 5799, 'compare_price' => 6499, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Training Shoes', 'name' => 'PUMA Fuse Training Shoes', 'price' => 4499, 'compare_price' => 4999, 'featured' => 0],

            // =========================
            // Sandals & Slides
            // =========================
            ['store' => 'Nike', 'category' => 'Sandals & Slides', 'name' => 'Nike Calm Slide', 'price' => 1999, 'compare_price' => 2299, 'featured' => 0],
            ['store' => 'Nike', 'category' => 'Sandals & Slides', 'name' => 'Nike Victori One Slide', 'price' => 1499, 'compare_price' => 1799, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Sandals & Slides', 'name' => 'adidas Adilette Slides', 'price' => 1399, 'compare_price' => 1599, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Sandals & Slides', 'name' => 'PUMA Leadcat Slides', 'price' => 1199, 'compare_price' => 1399, 'featured' => 0],

            // =========================
            // Hiking Shoes
            // =========================
            ['store' => 'Adidas', 'category' => 'Hiking Shoes', 'name' => 'adidas Terrex AX4', 'price' => 6499, 'compare_price' => 7299, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Hiking Shoes', 'name' => 'adidas Terrex Free Hiker 2', 'price' => 9999, 'compare_price' => 10999, 'featured' => 0],
            ['store' => 'New Balance', 'category' => 'Hiking Shoes', 'name' => 'New Balance Fresh Foam X Hierro v7', 'price' => 7499, 'compare_price' => 8499, 'featured' => 0],

            // =========================
            // Sportswear (Apparel-like category)
            // =========================
            ['store' => 'Nike', 'category' => 'Sportswear', 'name' => 'Nike Tech Fleece Hoodie', 'price' => 5999, 'compare_price' => 6999, 'featured' => 1],
            ['store' => 'Adidas', 'category' => 'Sportswear', 'name' => 'adidas Essentials 3-Stripes Hoodie', 'price' => 3499, 'compare_price' => 3999, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Sportswear', 'name' => 'PUMA Essentials Logo Tee', 'price' => 999, 'compare_price' => 1299, 'featured' => 0],
            ['store' => 'New Balance', 'category' => 'Sportswear', 'name' => 'New Balance Athletics T-Shirt', 'price' => 1199, 'compare_price' => 1499, 'featured' => 0],

            // =========================
            // Extra real models (to reach 50)
            // =========================
            ['store' => 'Nike', 'category' => 'Sneakers', 'name' => 'Nike Air Max 270', 'price' => 7499, 'compare_price' => 8499, 'featured' => 0],
            ['store' => 'Nike', 'category' => 'Sneakers', 'name' => 'Nike Blazer Mid 77', 'price' => 5499, 'compare_price' => 6299, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Sneakers', 'name' => 'adidas Gazelle', 'price' => 4799, 'compare_price' => 5299, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Running Shoes', 'name' => 'adidas Supernova Rise', 'price' => 5999, 'compare_price' => 6999, 'featured' => 0],
            ['store' => 'New Balance', 'category' => 'Sneakers', 'name' => 'New Balance 2002R', 'price' => 8499, 'compare_price' => 9499, 'featured' => 1],
            ['store' => 'Puma', 'category' => 'Sneakers', 'name' => 'PUMA RS-X', 'price' => 4999, 'compare_price' => 5799, 'featured' => 0],
            ['store' => 'Vans', 'category' => 'Skate Shoes', 'name' => 'Vans Era', 'price' => 2899, 'compare_price' => 3299, 'featured' => 0],
            ['store' => 'Nike', 'category' => 'Training Shoes', 'name' => 'Nike ZoomX SuperRep Surge', 'price' => 5999, 'compare_price' => 6999, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Football Boots', 'name' => 'adidas Copa Pure', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],
            ['store' => 'Puma', 'category' => 'Football Boots', 'name' => 'PUMA Ultra Ultimate', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],
            ['store' => 'Nike', 'category' => 'Basketball Shoes', 'name' => 'Nike Ja 1', 'price' => 7999, 'compare_price' => 8999, 'featured' => 0],
            ['store' => 'Adidas', 'category' => 'Basketball Shoes', 'name' => 'adidas Dame 8', 'price' => 6999, 'compare_price' => 7999, 'featured' => 0],
        ];

        // Ensure we have exactly 50 products
        // (لو كانوا أقل بسبب أي تعديل، هنكملهم بشكل تلقائي بمنتجات حقيقية إضافية)
        // لكن حالياً القائمة كبيرة، فهنتعامل بأمان:
        $products = array_slice($products, 0, 50);

        foreach ($products as $item) {
            $store_id = $storeId($item['store']);
            $category_id = $catId($item['category']);

            // لو store أو category مش موجودة (تحسبًا)
            if (!$store_id || !$category_id) {
                continue;
            }

            $name = $item['name'];

            Product::create([
                'store_id'      => $store_id,
                'category_id'   => $category_id,
                'name'          => $name,
                'product_image' => null, // انت هتحطها بعدين
                'slug'          => Str::slug($name),
                'show_in_home'  => $showInHomeOptions[array_rand($showInHomeOptions)],
                'description'   => $this->makeDescription($name, $item['category']),
                'price'         => $item['price'],
                'quantity'      => rand(10, 150),
                'options'       => null, // لو انت بتستخدم JSON options ابعتلي شكلها
                'compare_price' => $item['compare_price'] ?? null,
                'rate'          => rand(35, 50) / 10, // 3.5 to 5.0
                'featured'      => $item['featured'] ?? 0,
                'status'        => $statuses[array_rand($statuses)],
            ]);
        }
    }

    private function makeDescription(string $name, string $categoryName): string
    {
        return "$name is a popular item in the $categoryName category, designed for comfort, durability, and everyday performance.";
    }
}
