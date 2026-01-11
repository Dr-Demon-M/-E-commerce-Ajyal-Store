<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name = fake()->productName();
        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->numberBetween(1, 100),
            'options' => json_encode([
                'color' => $this->faker->randomElement(['red', 'blue', 'green']),
                'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL'])
            ]),
            'rate' => $this->faker->randomFloat(1, 0, 5),
            'featured' => $this->faker->numberBetween(10,100), // 20% احتمال يكون مميز
            'status' => $this->faker->randomElement(['active', 'draft', 'archived']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
