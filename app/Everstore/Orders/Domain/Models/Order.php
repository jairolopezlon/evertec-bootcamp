<?php

namespace App\Everstore\Orders\Domain\Models;

use App\Everstore\Orders\Domain\Enums\PaymentCurrencyEnum;
use App\Everstore\Orders\Domain\Enums\PaymentStatusEnum;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderPrimitive from Types
 * @phpstan-import-type OrderDetailPrimitive from Types
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
        private readonly PaymentCurrencyEnum $currency,
        private readonly string|null $paymentId,
        private readonly string|null $paymentUrl,
        private readonly array $orderDetails,
    ) {
    }

    /**
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
            'currency' => $this->currency->value,
            'paymentId' => $this->paymentId ?? null,
            'paymentUrl' => $this->paymentUrl ?? null,
            'orderDetails' => array_map(
                /**
                 * @return OrderDetailPrimitive
                 */
                function (OrderDetail $orderDetail) {
                    return $orderDetail->getAttributes();
                },
                $this->orderDetails
            ),
        ];
    }
}
