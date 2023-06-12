<?php

namespace Src\Orders\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;

enum PaymentStatusEnum: string
{
    use EnumFromValue;

    case COMPLETED = 'COMPLETED';
    case PROCESSING = 'PROCESSING';
    case CANCELLED = 'CANCELLED';
    case NOT_STARTED = 'NOT_STARTED';
}
