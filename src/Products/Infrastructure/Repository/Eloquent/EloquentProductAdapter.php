<?php

namespace Src\Products\Infrastructure\Repository\Eloquent;

use Src\Products\Domain\Models\ProductModel as DomainModel;
use Src\Products\Infrastructure\Repository\Eloquent\EloquentProductEntity as EloquentEntity;

class EloquentProductAdapter
{
    public static function toDomainModel(EloquentEntity $eloquentEntity): DomainModel
    {
        $domainModel = new DomainModel(
            $id = $eloquentEntity->id,
            $name = $eloquentEntity->name,
            $slug = $eloquentEntity->slug,
            $description = $eloquentEntity->description,
            $price = $eloquentEntity->price,
            $isEnable = $eloquentEntity->is_enable,
            $imageUrl = $eloquentEntity->image_url,
        );

        return $domainModel;
    }

    public static function toEloquentEntity(DomainModel $domainModel): EloquentEntity
    {
        $EloquentEntity = new EloquentEntity();
        $EloquentEntity->id = $domainModel->getId();
        $EloquentEntity->name = $domainModel->getName();
        $EloquentEntity->slug = $domainModel->getSlug();
        $EloquentEntity->description = $domainModel->getDescription();
        $EloquentEntity->price = $domainModel->getPrice();
        $EloquentEntity->is_enable = $domainModel->getIsEnable();
        $EloquentEntity->image_url = $domainModel->getImageUrl();

        return $EloquentEntity;
    }
}
