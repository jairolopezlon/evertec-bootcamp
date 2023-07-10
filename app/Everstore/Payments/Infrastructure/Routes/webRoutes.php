<?php

namespace App\Everstore\Payments\Infrastructure\Routes;

use App\Everstore\Payments\Infrastructure\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::post('/payments', [PaymentController::class, 'processPayment'])
    ->name('ecommerce.payments.processPayment');

Route::get('/payments/response', [PaymentController::class, 'processResponse'])
    ->name('ecommerce.payments.processResponse');
