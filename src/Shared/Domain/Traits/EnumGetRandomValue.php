<?php

namespace Src\Shared\Domain\Traits;

trait EnumGetRandomValue
{
    public static function enumGetRandomValue(): string
    {
        $enumToArray = array_map(function ($enum) {
            return $enum->value;
        }, self::cases());

        return array_rand($enumToArray);
    }
}