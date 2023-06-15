<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Src\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderDetailEntity as OrderDetail;
use Src\Orders\Infrastructure\Persistence\Eloquent\EloquentOrderEntity as Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //crear el usuario admin
        $userAdmin = User::factory()->state([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'type' => 'admin',
            'email_verified_at' => Carbon::now(),
        ])->create();
        Admin::factory()->state([
            'user_id' => $userAdmin->id,
        ])->create();
        Customer::factory()->state([
            'user_id' => $userAdmin->id,
        ])->create();

        // crear customer user
        $userCustomer = User::factory()->state([
            'name' => 'customer',
            'email' => 'customer@customer.com',
            'type' => 'customer',
            'email_verified_at' => Carbon::now(),
        ])->create();
        Customer::factory()->state([
            'user_id' => $userCustomer->id,
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

        // create 50 products
        Product::factory(50)->create();

        //order of customer user
        Order::factory(4)->state([
            'user_id' => $userCustomer,
        ])->create()->each(function ($order) {
            $order_id = $order->id;

            $products = Product::where('is_enabled', true)->where('has_availability', '>', 0)->get();
            $randomProducts = $products->random(rand(1, 5));

            $order_total = 0;

            $randomProducts->map(function ($product) use ($order_id, &$order_total) {
                $quantity = rand(1, 10);
                $product_price = $product->price;
                $subtotal = $product_price * $quantity;

                $order_total += $subtotal;

                return OrderDetail::factory()->state([
                    'order_id' => $order_id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product_price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ])->create();
            });

            $order->total = $order_total;
            $order->save();
        });

        //order of random users
        Order::factory(4)->create()->each(function ($order) {
            $order_id = $order->id;

            $products = Product::where('is_enabled', true)->where('has_availability', '>', 0)->get();
            $randomProducts = $products->random(rand(1, 5));

            $order_total = 0;

            $randomProducts->map(function ($product) use ($order_id, &$order_total) {
                $quantity = rand(1, 10);
                $product_price = (float) $product->price;
                $subtotal = $product_price * $quantity;

                $order_total += $subtotal;

                return OrderDetail::factory()->state([
                    'order_id' => $order_id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product_price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ])->create();
            });

            $order->total = $order_total;
            $order->save();
        });
    }
}
