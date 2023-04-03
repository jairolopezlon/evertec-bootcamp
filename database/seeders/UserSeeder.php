<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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

            $customer = \App\Models\Customer::factory()->make();
            $customer->user_id = $user->id;
            $customer->save();

            if ($user->type === 'admin') {
                $admin = \App\Models\Admin::factory()->make();
                $admin->user_id = $user->id;
                $admin->save();
            }
        });
    }
}
