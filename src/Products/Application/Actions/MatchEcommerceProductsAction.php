<?php

namespace Src\Products\Application\Actions;

use Src\Products\Domain\Dtos\ProductListEcommerceData;
use Src\Products\Domain\Repositories\ProductRepository;
use Src\Shared\Domain\ValueObjects\CriteriaFilterValue;
use Src\Shared\Domain\ValueObjects\CriteriaSortValue;
use Src\Shared\Domain\ValueObjects\CriteriaValue;

class MatchEcommerceProductsAction
{
    public function __construct(private ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param  array<mixed>  $searchParams
     * @return array<ProductListEcommerceData>
     */
    public function __invoke($searchParams)
    {
        $criteria = [];

        if (array_key_exists('filters', $searchParams)) {
            foreach ($searchParams['filters'] as $filter) {
                $criteria['filters'][] = new CriteriaFilterValue($filter['field'], $filter['value']);
            }
        }

        if (array_key_exists('limit', $searchParams)) {
            $criteria['limit'] = intval($searchParams['limit']);
        }

        if (array_key_exists('page', $searchParams)) {
            $criteria['offset'] = intval($searchParams['page']);
        }

        if (array_key_exists('sort', $searchParams)) {
            $criteria['sort'] = new CriteriaSortValue($searchParams['sort']);
        }

        $criteriaValue = new CriteriaValue($criteria);

        return $this->productRepository->matchEcommerceProducts($criteriaValue);
    }
}
