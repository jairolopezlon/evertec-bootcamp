<?php

namespace Src\Orders\Domain\Models;

use Src\Orders\Domain\Enums\PaymentStatusEnum;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderPrimitive from Types
 */
class Order
{
    /**
     * @param  array<OrderDetail>  $orderDetails
     */
    public function __construct(
        private readonly string $orderId,
        private readonly string $paymentProvider,
        private readonly string $userId,
        private readonly float $total,
        private readonly PaymentStatusEnum $paymentStatus,
        private readonly string $currency,
        private readonly string|null $paymentId,
        private readonly string|null $paymentUrl,
        private readonly int $orderDateTimestamps,
        private readonly array $orderDetails,
    ) {
    }

    /**
     * Summary of getAttributes
     *
     * @return OrderPrimitive
     */
    public function getAttributes()
    {
        return [
            'orderId' => $this->orderId,
            'paymentProvider' => $this->paymentProvider,
            'userId' => $this->userId,
            'total' => $this->total,
            'paymentStatus' => $this->paymentStatus->value,
            'currency' => $this->currency,
            'paymentId' => $this->paymentId ?? null,
            'paymentUrl' => $this->paymentUrl ?? null,
            'orderDateTimestamp' => $this->orderDateTimestamps,
            'orderDetails' => array_map(function (OrderDetail $orderDetail) {
                return $orderDetail->getAttributes();
            }, $this->orderDetails),
        ];
    }
}
