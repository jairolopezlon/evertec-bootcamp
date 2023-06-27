<?php

namespace App\Everstore\Products\Domain\ValuesObjects;

class ProductId
{
    public function __construct(private string $productId)
    {
        $this->productId = $productId;
    }

    public function value(): string
    {
        return $this->productId;
    }
}
