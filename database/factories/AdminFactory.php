<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Admin>
 */
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

    public function getAdminUser(): User
    {
        $user = User::factory()->state([
            'type' => 'admin',
        ])->create();

        Customer::factory()->state([
            'user_id' => $user->id,
        ])->create();

        Admin::factory()->state([
            'user_id' => $user->id,
        ])->create();

        return $user;
    }
}
