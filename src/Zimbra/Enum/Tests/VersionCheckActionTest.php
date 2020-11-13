<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\VersionCheckAction;

/**
 * Testcase class for VersionCheckAction.
 */
class VersionCheckActionTest extends TestCase
{
    public function testVersionCheckAction()
    {
        $values = [
            'CHECK'  => 'check',
            'STATUS' => 'status',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(VersionCheckAction::$enum()->getValue(), $value);
        }
    }
}
