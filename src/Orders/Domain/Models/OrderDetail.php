<?php

namespace Src\Orders\Domain\Models;

use Src\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type OrderDetailPrimitive from Types
 */
class OrderDetail
{
    public function __construct(
        private readonly string $orderDetailId,
        private readonly string $orderId,
        private readonly string $productId,
        private readonly string $productName,
        private readonly float $productPrice,
        private readonly int $quantity,
        private float $subtotal,
    ) {
        $this->subtotal = $this->productPrice * $this->quantity;
    }

    /**
     * Summary of getAttributes
     *
     * @return OrderDetailPrimitive
     */
    public function getAttributes()
    {
        return [
            'orderDetailId' => $this->orderDetailId,
            'orderId' => $this->orderId,
            'productId' => $this->productId,
            'productName' => $this->productName,
            'productPrice' => $this->productPrice,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
        ];
    }
}
