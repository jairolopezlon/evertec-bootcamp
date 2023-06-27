<?php

namespace App\Everstore\Shared\Domain\Traits;

trait EnumFromValue
{
    /**
     * @throws \ValueError
     */
    public static function enumFromValue(string $value): self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return throw new \ValueError("$value is not a valid backing value for enum ".self::class);
    }
}
