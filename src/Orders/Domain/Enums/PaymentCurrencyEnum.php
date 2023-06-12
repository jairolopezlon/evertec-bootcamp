<?php

namespace Src\Orders\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;

enum PaymentCurrencyEnum: string
{
    use EnumFromValue;

    case COP = 'COP';
    case USD = 'USD';
}
