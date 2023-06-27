<?php

namespace App\Everstore\Orders\Domain\Enums;

use App\Everstore\Shared\Domain\Traits\EnumFromValue;
use App\Everstore\Shared\Domain\Traits\EnumGetRandomValue;

enum PaymentStatusEnum: string
{
    use EnumFromValue;
    use EnumGetRandomValue;

    case COMPLETED = 'COMPLETED';
    case PROCESSING = 'PROCESSING';
    case CANCELLED = 'CANCELLED';
    case NOT_STARTED = 'NOT_STARTED';
}
