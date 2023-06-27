<?php

namespace App\Everstore\Checkout\Infrastructure\Routes;

use App\Everstore\Checkout\Infrastructure\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware(['auth'])
    ->name('ecommerce.checkout.index');
