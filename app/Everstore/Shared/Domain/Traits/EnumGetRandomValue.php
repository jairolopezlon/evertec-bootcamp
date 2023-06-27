<?php

namespace App\Everstore\Shared\Domain\Traits;

trait EnumGetRandomValue
{
    public static function enumGetRandomValue(): string
    {
        $enumToArray = array_map(function ($enum) {
            return $enum->value;
        }, self::cases());

        return $enumToArray[array_rand($enumToArray)];
    }
}
