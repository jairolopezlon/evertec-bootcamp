<?php

namespace Src\Orders\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Orders\Infrastructure\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index'])->middleware(['auth'])->name('ecommerce.orders.index');
Route::post('/orders', [OrderController::class, 'store'])->middleware(['auth'])->name('ecommerce.orders.store');
