<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\NumberComparison;

/**
 * Testcase class for NumberComparison.
 */
class NumberComparisonTest extends TestCase
{
    public function testNumberComparison()
    {
        $values = [
            'OVER' => 'over',
            'UNDER'  => 'under',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(NumberComparison::$enum()->getValue(), $value);
        }
    }
}
