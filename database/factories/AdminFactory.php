<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'is_superadmin' => $this->faker->boolean,
            'role' => $this->faker->word,
        ];
    }
}
