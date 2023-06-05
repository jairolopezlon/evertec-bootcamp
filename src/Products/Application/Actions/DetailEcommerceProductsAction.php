<?php

namespace Src\Products\Application\Actions;

use Src\Products\Domain\Repositories\ProductRepository;

class DetailEcommerceProductsAction
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle($slug)
    {
        return $this->productRepository->getEcommerceProductDetail($slug);
    }
}
