<?php

namespace Src\Orders\Infrastructure\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController
{
    public function index(Request $request): View
    {
        return view('pages.ecommerce.orders.orderList');
    }

    public function create(Request $request): View
    {
        return view('pages.ecommerce.orders.orderList');
    }
}
