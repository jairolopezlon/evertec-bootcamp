<?php

namespace Tests\Unit\src\Shared\Domain\ValueObjects;

use App\Everstore\Shared\Domain\ValueObjects\CriteriaSortValue;
use PHPUnit\Framework\TestCase;

class CriteriaSortValueTest extends TestCase
{
    public function testGetSortDirectionAscCase(): void
    {
        $testValue = 'price';
        $criteriaSortValue = new CriteriaSortValue($testValue);
        $direction = $criteriaSortValue->getDirection();

        $this->assertEquals(CriteriaSortValue::ASC_DIRECTION, $direction);
    }

    public function testGetSortDirectionDescCase(): void
    {
        $testValue = '-price';
        $criteriaSortValue = new CriteriaSortValue($testValue);
        $direction = $criteriaSortValue->getDirection();

        $this->assertEquals(CriteriaSortValue::DESC_DIRECTION, $direction);
    }
}
