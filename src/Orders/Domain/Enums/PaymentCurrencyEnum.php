<?php

namespace Src\Orders\Domain\Enums;

enum PaymentCurrencyEnum: string
{
    case COP = 'COP';
    case USD = 'USD';

    public static function fromName(string $name): PaymentCurrencyEnum
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum ".self::class);
    }
}
