<?php

namespace App\Everstore\Products\Domain\Models;

use App\Everstore\Products\Domain\ValuesObjects\ProductId;
use App\Everstore\Shared\Domain\Types\Types;

/**
 * @phpstan-import-type ProductPrimitive from Types
 */
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

    public function getId(): ProductId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getIsEnable(): bool
    {
        return $this->isEnable;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @return ProductPrimitive
     */
    public function getAttributes(): array
    {
        return [
            'id' => $this->id->value(),
            'imageUrl' => $this->imageUrl,
            'isEnable' => $this->isEnable,
            'name' => $this->name,
            'price' => $this->price,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }
}
