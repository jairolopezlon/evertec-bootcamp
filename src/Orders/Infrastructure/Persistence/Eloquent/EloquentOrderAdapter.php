<?php

namespace Src\Orders\Infrastructure\Persistence\Eloquent;

use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentStatusEnum;
use Src\Orders\Domain\Models\Order;

class EloquentOrderAdapter
{
    public static function toDomainModel(EloquentOrderEntity $eloquentOrderEntity): Order
    {
        $orderDetails = $eloquentOrderEntity->orderDetails->map(function ($orderDetail) {
            return EloquentOrderDetailAdapter::toDomainModel($orderDetail);
        })->toArray();

        return new Order(
            (string) $eloquentOrderEntity->id,
            $eloquentOrderEntity->payment_provider,
            "{$eloquentOrderEntity->user_id}",
            $eloquentOrderEntity->total,
            PaymentStatusEnum::fromName($eloquentOrderEntity->payment_status),
            PaymentCurrencyEnum::fromName($eloquentOrderEntity->currency),
            $eloquentOrderEntity->payment_id,
            $eloquentOrderEntity->payment_url,
            $orderDetails
        );
    }

    public static function toEloquentEntity(Order $order): EloquentOrderEntity
    {
        $eloquentEntity = new EloquentOrderEntity();

        $orderAttributes = $order->getAttributes();

        $eloquentEntity->id = (int) $orderAttributes['orderId'];
        $eloquentEntity->payment_provider = $orderAttributes['paymentProvider'];
        $eloquentEntity->user_id = (int) $orderAttributes['userId'];
        $eloquentEntity->total = $orderAttributes['total'];
        $eloquentEntity->payment_status = $orderAttributes['paymentStatus'];
        $eloquentEntity->currency = $orderAttributes['currency'];
        $eloquentEntity->payment_id = $orderAttributes['paymentId'] ?? null;
        $eloquentEntity->payment_url = $orderAttributes['paymentUrl'] ?? null;

        return $eloquentEntity;
    }
}
