<?php

namespace Src\Products\Domain\Dtos;

use Src\Products\Domain\Models\ProductModel;

class ProductListEcommerceData
{
    public $id;

    public $name;

    public $slug;

    public $description;

    public $price;

    public $imageUrl;

    public function __construct(ProductModel $productModel)
    {
        $this->id = $productModel->getId();
        $this->name = $productModel->getName();
        $this->slug = $productModel->getSlug();
        $this->description = $productModel->getDescription();
        $this->price = $productModel->getPrice();
        $this->imageUrl = $productModel->getImageUrl();
    }
}
