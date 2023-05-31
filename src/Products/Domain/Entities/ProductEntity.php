<?php

namespace Src\Products\Domain\Entities;

class ProductEntity
{
    private $id;

    private $name;

    private $slug;

    private $description;

    private $price;

    private $isEnable;

    private $imageUrl;

    public function __construct(int $id, string $name, string $slug, string $description, float $price, bool $isEnable, string $imageUrl)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->isEnable = $isEnable;
        $this->imageUrl = $imageUrl;
    }
}
