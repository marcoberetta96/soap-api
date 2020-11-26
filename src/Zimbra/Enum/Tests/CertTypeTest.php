<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\CertType;

/**
 * Testcase class for CertType.
 */
class CertTypeTest extends TestCase
{
    public function testCertType()
    {
        $values = [
            'ALL'      => 'all',
            'MTA'      => 'mta',
            'LDAP'     => 'ldap',
            'MAILBOXD' => 'mailboxd',
            'PROXY'    => 'proxy',
            'STAGED'   => 'staged',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(CertType::$enum()->getValue(), $value);
        }
    }
}
