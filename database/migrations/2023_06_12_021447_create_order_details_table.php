<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->unsignedDouble('product_price');
            $table->unsignedInteger('quantity');
            $table->unsignedDouble('subtotal');
            $table->timestamps();

            $table->foreign('order_id')->on('orders')->references('id');
            $table->foreign('product_id')->on('products')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
