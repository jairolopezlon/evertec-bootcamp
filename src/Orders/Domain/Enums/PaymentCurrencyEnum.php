<?php

namespace Src\Orders\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;
use Src\Shared\Domain\Traits\EnumGetRandomValue;
use Src\Shared\Domain\Traits\EnumToArray;

enum PaymentCurrencyEnum: string
{
    use EnumFromValue;
    use EnumToArray;
    use EnumGetRandomValue;

    case COP = 'COP';
    case USD = 'USD';
}
