<?php

namespace App\Everstore\ShoppingCart\Domain\Enums;

enum UpdateOptionsEnum: string
{
    case INCREMENT = 'INCREMENT';
    case DECREMENT = 'DECREMENT';
}
