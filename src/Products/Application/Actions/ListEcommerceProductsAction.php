<?php

namespace Src\Products\Application\Actions;

use Src\Products\Domain\Repositories\ProductRepository;

class ListEcommerceProductsAction
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle()
    {
        return $this->productRepository->ListEcommerceProducts();
    }
}
