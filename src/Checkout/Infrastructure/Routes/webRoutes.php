<?php

namespace Src\Checkout\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Checkout\Infrastructure\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware(['auth'])
    ->name('ecommerce.checkout.index');
