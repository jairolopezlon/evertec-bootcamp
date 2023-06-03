<?php

namespace Src\Products\Domain\Models;

class ProductModel
{
    private $id;

    private $name;

    private $slug;

    private $description;

    private $price;

    private $isEnable;

    private $imageUrl;

    public function __construct(
        int $id,
        string $name,
        string $slug,
        string $description,
        float $price,
        bool $isEnable,
        string $imageUrl
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->isEnable = $isEnable;
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return int
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
