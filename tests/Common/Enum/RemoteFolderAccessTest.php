<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RemoteFolderAccess;

/**
 * Testcase class for RemoteFolderAccess.
 */
class RemoteFolderAccessTest extends TestCase
{
    public function testRemoteFolderAccess()
    {
        $values = [
            'CREATE' => 'c',
            'INSERT' => 'i',
            'READ'   => 'r',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(RemoteFolderAccess::$enum()->getValue(), $value);
        }
    }
}
