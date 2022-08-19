<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\CountComparison;

/**
 * Testcase class for CountComparison.
 */
class CountComparisonTest extends TestCase
{
    public function testCountComparison()
    {
        $values = [
            'GREATER_THAN'  => 'gt',
            'GREATER_EQUAL' => 'ge',
            'LESS_THAN'     => 'lt',
            'LESS_EQUAL'    => 'le',
            'EQUAL'         => 'eq',
            'NOT_EQUAL'     => 'ne',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CountComparison::$enum()->getValue(), $value);
        }
    }
}
