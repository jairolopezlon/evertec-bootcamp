<?php

namespace App\Everstore\Products\Application\Actions;

use App\Everstore\Products\Domain\Dtos\ProductDetailEcommerceData;
use App\Everstore\Products\Domain\Repositories\ProductRepository;

class DetailEcommerceProductsAction
{
    public function __construct(private ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(string $slug): ProductDetailEcommerceData
    {
        return $this->productRepository->getEcommerceProductDetail($slug);
    }
}
