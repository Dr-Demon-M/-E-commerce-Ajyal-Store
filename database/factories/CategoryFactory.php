<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->category();
        return [
            'parent_id' => null, // ممكن تحدد parent بعد الإنشاء أو تستخدم factory لتوليد parent
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement(['active', 'archived']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
