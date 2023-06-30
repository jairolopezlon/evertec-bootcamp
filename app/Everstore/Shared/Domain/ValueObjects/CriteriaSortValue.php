<?php

namespace App\Everstore\Shared\Domain\ValueObjects;

use App\Everstore\Shared\Domain\Enums\SortDirectionEnum;

class CriteriaSortValue
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var SortDirectionEnum
     */
    private $direction;

    /**
     * @var SortDirectionEnum::DESC
     */
    public const DESC_DIRECTION = SortDirectionEnum::DESC;

    /**
     * @var SortDirectionEnum::ASC
     */
    public const ASC_DIRECTION = SortDirectionEnum::ASC;

    public const DIRECTION_INDICARTOR = '-';

    public function __construct(string $field)
    {
        $this->field = str_replace(self::DIRECTION_INDICARTOR, '', $field);
        $this->direction = str_starts_with($field, self::DIRECTION_INDICARTOR)
            ? self::DESC_DIRECTION
            : self::ASC_DIRECTION;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getDirection(): SortDirectionEnum
    {
        return $this->direction;
    }
}
