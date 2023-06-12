<?php

namespace Src\Products\Application\Actions;

use Src\Products\Domain\Dtos\ProductDetailEcommerceData;
use Src\Products\Domain\Repositories\ProductRepository;

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
