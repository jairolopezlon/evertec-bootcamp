<?php

namespace Src\Products\Domain\Models;

class ProductId
{
    public function __construct(private string|int $productId)
    {
        $this->productId = $productId;
    }

    public function value(): string|int
    {
        return $this->productId;
    }
}
