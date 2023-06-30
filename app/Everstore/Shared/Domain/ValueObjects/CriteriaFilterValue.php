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

    public function getField(): string
    {
        return $this->field;
    }

    public function getValue(): string|int|bool|float
    {
        return $this->value;
    }
}
