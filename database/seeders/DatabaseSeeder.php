<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin::factory(5)->create();
        // User::factory(4)->create();
        // Category::factory(5)->create();
        // Store::factory(5)->create();
        // Product::factory(10)->create();
        // $this->call(UserSeeder::class);
        $this->call([CategorySeeder::class, StoreSeeder::class, ProductSeeder::class]);
    }
}
