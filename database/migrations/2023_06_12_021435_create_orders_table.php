<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('payment_provider');
            $table->unsignedBigInteger('user_id');
            $table->double('total');
            $table->enum('payment_status', ['CANCELLED', 'COMPLETED', 'NOT_STARTED', 'PROCESSING'])
                ->default('NOT_STARTED');
            $table->enum('currency', ['COP', 'USD'])
                ->default('COP');
            $table->string('payment_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
