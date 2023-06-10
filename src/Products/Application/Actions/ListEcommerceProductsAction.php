<?php

namespace Src\Products\Application\Actions;

use Src\Products\Domain\Dtos\ProductListEcommerceData;
use Src\Products\Domain\Repositories\ProductRepository;

class ListEcommerceProductsAction
{
    public function __construct(private ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return array<ProductListEcommerceData>
     */
    public function handle()
    {
        return $this->productRepository->listEcommerceProducts();
    }
}
