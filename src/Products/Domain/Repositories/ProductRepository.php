<?php

namespace Src\Products\Domain\Repositories;

use Src\Products\Domain\Dtos\ProductDetailEcommerceData;
use Src\Products\Domain\Dtos\ProductListEcommerceData;
use Src\Shared\Domain\ValueObjects\CriteriaValue;

interface ProductRepository
{
    /**
     * @return array<ProductListEcommerceData>
     */
    public function listEcommerceProducts();

    /**
     * @return ProductDetailEcommerceData
     */
    public function getEcommerceProductDetail(string $slug);

    /**
     * @return array<ProductListEcommerceData>
     */
    public function matchEcommerceProducts(CriteriaValue $criteriaValue);
}
