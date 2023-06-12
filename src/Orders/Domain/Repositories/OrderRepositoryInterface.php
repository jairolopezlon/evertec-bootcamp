<?php

namespace Src\Orders\Domain\Repositories;

use Src\Orders\Domain\Models\Order;

interface OrderRepositoryInterface
{
    public function createOrder(Order $order): Order;
}
