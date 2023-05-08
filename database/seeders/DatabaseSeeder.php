<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //crear el usuario admin
        $userAdmin = User::factory()->state([
            "name" => "admin",
            "email" => "admin@admin.com",
            'type' => 'admin',
            "email_verified_at" => Carbon::now(),
        ])->create();
        Admin::factory()->state([
            'user_id' => $userAdmin->id,
        ])->create();
        Customer::factory()->state([
            'user_id' => $userAdmin->id,
        ])->create();

        // crear usuarios random
        User::factory(50)->create()->each(function ($user) {
            Customer::factory()->state([
                'user_id' => $user->id,
            ])->create();

            if ($user->type === 'admin') {
                Admin::factory()->state([
                    'user_id' => $user->id,
                ])->create();
            }
        });

        // crear productos
        Product::factory(10)->create();
    }
}
