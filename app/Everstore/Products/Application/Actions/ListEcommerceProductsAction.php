<?php

namespace App\Everstore\Products\Application\Actions;

use App\Everstore\Products\Domain\Dtos\ProductListEcommerceData;
use App\Everstore\Products\Domain\Repositories\ProductRepository;

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
