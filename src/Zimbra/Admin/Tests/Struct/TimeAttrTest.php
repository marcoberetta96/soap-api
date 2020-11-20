<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\TimeAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TimeAttr.
 */
class TimeAttrTest extends ZimbraStructTestCase
{
    public function testTimeAttr()
    {
        $time = $this->faker->iso8601;
        $attr = new TimeAttr($time);
        $this->assertSame($time, $attr->getTime());

        $attr = new TimeAttr('');
        $attr->setTime($time);
        $this->assertSame($time, $attr->getTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr time="' . $time . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, TimeAttr::class, 'xml'));

        $json = json_encode([
            'time' => $time,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, TimeAttr::class, 'json'));
    }
}
