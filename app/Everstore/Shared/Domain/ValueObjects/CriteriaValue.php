<?php

namespace App\Everstore\Shared\Domain\ValueObjects;

/**
 * @phpstan-type CriteriaType array{
 *     filters?: array<CriteriaFilterValue>,
 *     sort?: CriteriaSortValue,
 *     limit?: int,
 *     offset?: int
 * }
 */
class CriteriaValue
{
    /**
     * @var array<CriteriaFilterValue>
     */
    private $filters;

    /**
     * @var CriteriaSortValue
     */
    private $sort;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $offset;

    /**
     * Summary of __construct
     *
     * @param  CriteriaType  $criteria
     */
    public function __construct(array $criteria)
    {
        $this->filters = $criteria['filters'] ?? []; //crear el valueObject
        $this->sort = $criteria['sort'] ?? null; //crear el valueObject
        $this->limit = $criteria['limit'] ?? 20; //crear el valueObject
        $this->offset = $criteria['offset'] ?? 1; //crear el valueObject
    }

    public function validateThereAreFilters(): bool
    {
        return count($this->filters) > 0;
    }

    /**
     * @return array<CriteriaFilterValue>
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function getSort(): CriteriaSortValue|null
    {
        return $this->sort;
    }
}
