<?php

namespace Src\Products\Domain\Repositories;

use Src\Domain\ValueObjects\CriteriaValue;
use Src\Products\Domain\Dtos\ProductDetailEcommerceData;
use Src\Products\Domain\Dtos\ProductListEcommerceData;

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
