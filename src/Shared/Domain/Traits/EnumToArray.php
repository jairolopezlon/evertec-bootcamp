<?php

namespace Src\Shared\Domain\Traits;

trait EnumToArray
{
    public static function enumToArray(): array
    {
        $enumToArray = array_map(function ($enum) {
            return $enum->value;
        }, self::cases());

        return $enumToArray;
    }
}
