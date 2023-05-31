<?php

namespace Src\Products\Infrastructure\Repository\Eloquent;

use Src\Products\Domain\Repositories\ProductRepository;

class EloquentProductRespositoryImpl implements ProductRepository
{
    private $productModel;

    public function __construct(EloquentProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    public function ListEcommerceProducts()
    {
        $enableProducts = $this->productModel::where('is_enable', true)->get();

        return $enableProducts;
    }

    public function GetEcommerceProductDetail($slug)
    {
        $product = $this->productModel::where('slug', $slug)->first();

        return $product;
    }
}
