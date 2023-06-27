<?php

namespace App\Everstore\Products\Domain\Models;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;

class ProductModel
{
    public function __construct(
        private ProductId $id,
        private string $name,
        private string $slug,
        private string $description,
        private float $price,
        private bool $isEnable,
        private string $imageUrl
    ) {
    }

    /**
     * @return ProductId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function getIsEnable()
    {
        return $this->isEnable;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @return array<string, mixed>
     */
    public function getAttributes()
    {
        return [
            'description' => $this->description,
            'id' => $this->id,
            'imageUrl' => $this->imageUrl,
            'isEnable' => $this->isEnable,
            'name' => $this->name,
            'price' => $this->price,
            'slug' => $this->slug,
        ];
    }
}
