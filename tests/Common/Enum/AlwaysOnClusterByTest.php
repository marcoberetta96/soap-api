<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AlwaysOnClusterBy;

/**
 * Testcase class for AlwaysOnClusterBy.
 */
class AlwaysOnClusterByTest extends TestCase
{
    public function testAlwaysOnClusterBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AlwaysOnClusterBy::$enum()->getValue(), $value);
        }
    }
}
