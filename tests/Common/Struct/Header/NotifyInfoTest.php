<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct\Header;

use Zimbra\Common\Struct\Header\NotifyInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NotifyInfo.
 */
class NotifyInfoTest extends ZimbraTestCase
{
    public function testHeaderNotifyInfo()
    {
        $sequence = $this->faker->randomNumber;

        $info = new NotifyInfo($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $info = new NotifyInfo();
        $info->setSequenceNum($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seq="$sequence" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, NotifyInfo::class, 'xml'));
    }
}
