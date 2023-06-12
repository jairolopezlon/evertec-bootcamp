<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use Src\Orders\Domain\Models\OrderDetail;

class EloquentOrderDetailAdapter
{
    public static function toDomainModel(EloquentOrderDetailEntity $eloquentOrderDetailEntity): OrderDetail
    {
        return new OrderDetail(
            (string) $eloquentOrderDetailEntity->id,
            (string) $eloquentOrderDetailEntity->order_id,
            (string) $eloquentOrderDetailEntity->product_id,
            $eloquentOrderDetailEntity->product_name,
            $eloquentOrderDetailEntity->product_price,
            $eloquentOrderDetailEntity->quantity,
            $eloquentOrderDetailEntity->subtotal,
        );
    }

    public static function toEloquentEntity(OrderDetail $orderDetail): EloquentOrderDetailEntity
    {
        $eloquentEntity = new EloquentOrderDetailEntity();

        $orderDetailAttributes = $orderDetail->getAttributes();

        $eloquentEntity->id = (int) $orderDetailAttributes['orderDetailId'];
        $eloquentEntity->order_id = (int) $orderDetailAttributes['orderId'];
        $eloquentEntity->product_id = (int) $orderDetailAttributes['productId'];
        $eloquentEntity->product_name = $orderDetailAttributes['productName'];
        $eloquentEntity->product_price = $orderDetailAttributes['price'];
        $eloquentEntity->quantity = $orderDetailAttributes['quantity'];
        $eloquentEntity->subtotal = $orderDetailAttributes['subtotal'];

        return $eloquentEntity;
    }
}
