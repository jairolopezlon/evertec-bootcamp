<?php

namespace Src\Shared\Domain\Traits;

trait EnumToArray
{
    /**
     * @return array<int, string>
     */
    public static function enumToArray()
    {
        $enumToArray = array_map(function ($enum) {
            return $enum->value;
        }, static::cases());

        return $enumToArray;
    }
}
