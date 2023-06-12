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
        private readonly float $price,
        private readonly int $quantity,
        private float $subtotal,
    ) {
        $this->subtotal = $this->price * $this->quantity;
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
            'price' => $this->price,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal,
        ];
    }
}
