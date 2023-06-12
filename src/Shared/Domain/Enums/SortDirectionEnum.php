<?php

namespace Src\Shared\Domain\Enums;

use Src\Shared\Domain\Traits\EnumFromValue;

enum SortDirectionEnum: string
{
    use EnumFromValue;

    case ASC = 'asc';
    case DESC = 'desc';
}
