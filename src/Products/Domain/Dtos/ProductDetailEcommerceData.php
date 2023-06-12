<?php

namespace Src\Products\Domain\Dtos;

use Src\Products\Domain\Models\ProductModel;

class ProductDetailEcommerceData
{
    public string $id;

    public string $name;

    public string $slug;

    public string $description;

    public float $price;

    public string $imageUrl;

    public function __construct(ProductModel $productModel)
    {
        $this->id = $productModel->getId()->value();
        $this->name = $productModel->getName();
        $this->slug = $productModel->getSlug();
        $this->description = $productModel->getDescription();
        $this->price = $productModel->getPrice();
        $this->imageUrl = $productModel->getImageUrl();
    }
}
