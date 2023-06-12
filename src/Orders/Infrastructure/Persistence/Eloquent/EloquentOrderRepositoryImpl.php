<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use Src\Orders\Domain\Models\Order;
use Src\Orders\Domain\Repositories\OrderRepositoryInterface;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderPrimitive from Types
 */
class EloquentOrderRepositoryImpl implements OrderRepositoryInterface
{
    public function createOrder(Order $order): Order
    {
        $entity = EloquentOrderAdapter::toEloquentEntity($order);

        $entity->save();

        $orderDetails = array_map(function ($orderDetails) use ($entity) {
            return [
                'order_id' => $entity->id,
                'product_id' => $orderDetails['productId'],
                'product_name' => $orderDetails['productName'],
                'product_price' => $orderDetails['productPrice'],
                'quantity' => $orderDetails['quantity'],
                'subtotal' => $orderDetails['subtotal'],
            ];
        }, $order->getAttributes()['orderDetails']);

        $entity->orderDetails()->createMany($orderDetails);

        return $order;
    }
}
