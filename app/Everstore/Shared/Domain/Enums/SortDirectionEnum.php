<?php

namespace App\Everstore\Shared\Domain\Enums;

use App\Everstore\Shared\Domain\Traits\EnumFromValue;

enum SortDirectionEnum: string
{
    use EnumFromValue;

    case ASC = 'asc';
    case DESC = 'desc';
}
