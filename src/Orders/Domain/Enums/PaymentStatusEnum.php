<?php

namespace Src\Orders\Domain\Enums;

enum PaymentStatusEnum: string
{
    case COMPLETED = 'COMPLETED';
    case PROCESSING = 'PROCESSING';
    case CANCELLED = 'CANCELLED';
    case NOT_STARTED = 'NOT_STARTED';
}
