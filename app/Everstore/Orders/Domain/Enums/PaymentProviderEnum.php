<?php

namespace App\Everstore\Orders\Domain\Enums;

use App\Everstore\Shared\Domain\Traits\EnumFromValue;
use App\Everstore\Shared\Domain\Traits\EnumGetRandomValue;
use App\Everstore\Shared\Domain\Traits\EnumToArray;

enum PaymentProviderEnum: string
{
    use EnumFromValue;
    use EnumToArray;
    use EnumGetRandomValue;

    case PAYPAL = 'PAYPAL';
    case PLACETOPAY = 'PLACETOPAY';
    case MERCADOPAGO = 'MERCADOPAGO';
}
