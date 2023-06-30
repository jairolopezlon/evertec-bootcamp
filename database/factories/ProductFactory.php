<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = $this->faker->numberBetween(0, 50);
        $hasAvailability = ($stock > 0);
        $name = $this->faker->sentence(3);
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $stock,
            'is_enabled' => $this->faker->boolean(),
            'has_availability' => $hasAvailability,
            'image_url' => $this->faker->imageUrl(),
            'slug' => $slug,
        ];
    }

    public function enable(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => true,
            ];
        });
    }

    public function disable(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_enabled' => false,
            ];
        });
    }

    public function availability(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'has_availability' => true,
                'stock' => $this->faker->numberBetween(1, 50),
            ];
        });
    }

    public function unavailability(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'has_availability' => false,
                'stock' => 0,
            ];
        });
    }
}
