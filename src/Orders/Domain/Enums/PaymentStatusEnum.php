<?php

namespace Src\Orders\Domain\Enums;

enum PaymentStatusEnum: string
{
    case COMPLETED = 'COMPLETED';
    case PROCESSING = 'PROCESSING';
    case CANCELLED = 'CANCELLED';
    case NOT_STARTED = 'NOT_STARTED';

    public static function fromName(string $name): PaymentStatusEnum
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum ".self::class);
    }
}
