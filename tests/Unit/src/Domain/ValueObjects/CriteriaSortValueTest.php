<?php

namespace Tests\Unit\src\Domain\ValueObjects;

use PHPUnit\Framework\TestCase;
use Src\Domain\ValueObjects\CriteriaSortValue;

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
