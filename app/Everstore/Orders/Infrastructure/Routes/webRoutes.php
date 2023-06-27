<?php

namespace App\Everstore\Orders\Infrastructure\Routes;

use App\Everstore\Orders\Infrastructure\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('ecommerce.orders.index');
Route::post('/orders', [OrderController::class, 'store'])->middleware(['auth'])->name('ecommerce.orders.store');
