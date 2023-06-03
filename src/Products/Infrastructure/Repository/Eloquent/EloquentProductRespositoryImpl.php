<?php

namespace Src\Products\Infrastructure\Repository\Eloquent;

use Src\Products\Domain\Dtos\ProductDetailEcommerceData;
use Src\Products\Domain\Dtos\ProductListEcommerceData;
use Src\Products\Domain\Repositories\ProductRepository;

class EloquentProductRespositoryImpl implements ProductRepository
{
    private $productModel;

    public function __construct(EloquentProductEntity $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * @return array<ProductListEcommerceData>
     */
    public function listEcommerceProducts()
    {
        $enableProducts = $this->productModel::where('is_enable', true)->get();
        $listProducts = [];
        foreach ($enableProducts as $product) {
            $productModel = EloquentProductAdapter::toDomainModel($product);
            $listProducts[] = new ProductListEcommerceData($productModel);
        }

        return $listProducts;
    }

    /**
     * @return ProductDetailEcommerceData
     */
    public function getEcommerceProductDetail($slug)
    {
        $product = $this->productModel::where('slug', $slug)->first();
        $productModel = EloquentProductAdapter::toDomainModel($product);
        $productData = new ProductDetailEcommerceData($productModel);

        return $productData;
    }
}
