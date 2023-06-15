<?php

namespace Src\Orders\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;
use Src\Shared\Domain\Traits\EnumGetRandomValue;
use Src\Shared\Domain\Traits\EnumToArray;

enum PaymentProviderEnum: string
{
    use EnumFromValue;
    use EnumToArray;
    use EnumGetRandomValue;

    case PAYPAL = 'PAYPAL';
    case PLACETOPAY = 'PLACETOPAY';
    case MERCADOPAGO = 'MERCADOPAGO';
}
