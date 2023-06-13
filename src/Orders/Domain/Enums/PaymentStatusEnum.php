<?php

namespace Src\Orders\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;
use Src\Shared\Domain\Traits\EnumGetRandomValue;

enum PaymentStatusEnum: string
{
    use EnumFromValue;
    use EnumGetRandomValue;

    case COMPLETED = 'COMPLETED';
    case PROCESSING = 'PROCESSING';
    case CANCELLED = 'CANCELLED';
    case NOT_STARTED = 'NOT_STARTED';
}
