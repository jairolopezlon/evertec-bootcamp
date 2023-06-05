<?php

namespace Src\Domain\ValueObjects;

use Src\Domain\Enums\SortDirectionEnum;

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

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return SortDirectionEnum
     */
    public function getDirection()
    {
        return $this->direction;
    }
}
