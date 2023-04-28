<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(20)->create()->each(function ($user) {
            Customer::factory()->state([
                'user_id' => $user->id,
            ])->create();

            if ($user->type === 'admin') {
                Admin::factory()->state([
                    'user_id' => $user->id,
                ])->create();
            }
        });
    }
}
