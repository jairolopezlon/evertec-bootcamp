<?php

namespace Src\Orders\Domain\Dtos;

use Src\Orders\Domain\Models\Order;
use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderListPrimitive from Types
 */
class OrderListData
{
    public function __construct(
        private readonly Order $orderDomain
    ) {
    }

    /**
     * @return OrderListPrimitive
     */
    public function toArray(): array
    {
        $orderDomainAttributes = $this->orderDomain->getAttributes();

        return [
            'orderId' => $orderDomainAttributes['orderId'],
            'paymentProvider' => $orderDomainAttributes['paymentProvider'],
            'userId' => $orderDomainAttributes['userId'],
            'total' => $orderDomainAttributes['total'],
            'paymentStatus' => $orderDomainAttributes['paymentStatus'],
            'currency' => $orderDomainAttributes['currency'],
        ];
    }
}
