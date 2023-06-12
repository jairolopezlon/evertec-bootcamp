<?php

namespace Src\Orders\Infrastructure\Routes;

use Illuminate\Support\Facades\Route;
use Src\Orders\Infrastructure\Controllers\OrderController;

Route::get('/order', [OrderController::class, 'index']);
Route::get('/order', [OrderController::class, 'create']);
