<?php

namespace App\Everstore\Shared\Domain\ValueObjects;

class CriteriaFilterValue
{
    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $field, mixed $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string|int|bool|float
     */
    public function getValue()
    {
        return $this->value;
    }
}
