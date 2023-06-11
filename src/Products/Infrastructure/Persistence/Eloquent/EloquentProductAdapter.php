<?php

namespace Src\Products\Infrastructure\Persistence\Eloquent;

use Src\Products\Domain\Models\ProductModel as DomainModel;
use Src\Products\Domain\ValuesObjects\ProductId;
use Src\Products\Infrastructure\Persistence\Eloquent\EloquentProductEntity as EloquentEntity;

class EloquentProductAdapter
{
    public static function toDomainModel(EloquentEntity $eloquentEntity): DomainModel
    {
        $domainModel = new DomainModel(
            $id = new ProductId((string) $eloquentEntity->id),
            $name = $eloquentEntity->name,
            $slug = $eloquentEntity->slug,
            $description = $eloquentEntity->description,
            $price = $eloquentEntity->price,
            $isEnable = $eloquentEntity->is_enabled,
            $imageUrl = $eloquentEntity->image_url,
        );

        return $domainModel;
    }

    public static function toEloquentEntity(DomainModel $domainModel): EloquentEntity
    {
        $EloquentEntity = new EloquentEntity();
        $EloquentEntity->id = (int) $domainModel->getId()->value();
        $EloquentEntity->name = $domainModel->getName();
        $EloquentEntity->slug = $domainModel->getSlug();
        $EloquentEntity->description = $domainModel->getDescription();
        $EloquentEntity->price = $domainModel->getPrice();
        $EloquentEntity->is_enabled = $domainModel->getIsEnable();
        $EloquentEntity->image_url = $domainModel->getImageUrl();

        return $EloquentEntity;
    }
}
