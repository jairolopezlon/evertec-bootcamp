<?php

namespace Src\Orders\Domain\Models;

use Src\Orders\Domain\Enums\PaymentCurrencyEnum;
use Src\Orders\Domain\Enums\PaymentStatusEnum;
use Src\Shared\Domain\Types\Types;

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
