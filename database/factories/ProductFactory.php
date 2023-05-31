<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'is_enable' => $this->faker->boolean(),
            'image_url' => $this->faker->imageUrl(),
            'slug' => $this->faker->unique()->slug(),
        ];
    }

    public function enable(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enable' => true,
            ];
        });
    }

    public function disable(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enable' => false,
            ];
        });
    }
}
