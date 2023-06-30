<?php

namespace App\Everstore\Products\Domain\Repositories;

use App\Everstore\Products\Domain\Dtos\ProductDetailEcommerceData;
use App\Everstore\Products\Domain\Dtos\ProductListEcommerceData;
use App\Everstore\Shared\Domain\ValueObjects\CriteriaValue;

interface ProductRepository
{
    /**
     * @return array<ProductListEcommerceData>
     */
    public function listEcommerceProducts(): array;

    public function getEcommerceProductDetail(string $slug): ProductDetailEcommerceData;

    /**
     * @return array<ProductListEcommerceData>
     */
    public function matchEcommerceProducts(CriteriaValue $criteriaValue): array;
}
