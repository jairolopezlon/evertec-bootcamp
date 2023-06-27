<?php

namespace App\Everstore\Orders\Infrastructure\Persistence\Eloquent;

use App\Everstore\Orders\Domain\Models\OrderDetail;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderDetailPrimitive from Types
 */
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

        /**
         * @var OrderDetailPrimitive
         */
        $orderDetailAttributes = $orderDetail->getAttributes();

        $eloquentEntity->id = (int) $orderDetailAttributes['orderDetailId'];
        $eloquentEntity->order_id = (int) $orderDetailAttributes['orderId'];
        $eloquentEntity->product_id = (int) $orderDetailAttributes['productId'];
        $eloquentEntity->product_name = $orderDetailAttributes['productName'];
        $eloquentEntity->product_price = $orderDetailAttributes['productPrice'];
        $eloquentEntity->quantity = $orderDetailAttributes['quantity'];
        $eloquentEntity->subtotal = $orderDetailAttributes['subtotal'];

        return $eloquentEntity;
    }
}
