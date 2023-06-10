<?php

namespace Src\ShoppingCart\Domain\Enums;

enum UpdateOptionsEnum: string
{
    case INCREMENT = 'INCREMENT';
    case DECREMENT = 'DECREMENT';
}
