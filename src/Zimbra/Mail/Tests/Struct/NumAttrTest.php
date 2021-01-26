<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\NumAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for NumAttr.
 */
class NumAttrTest extends ZimbraStructTestCase
{
    public function testNumAttr()
    {
        $num = mt_rand(1, 100);

        $attr = new NumAttr($num);
        $this->assertSame($num, $attr->getNum());

        $attr = new NumAttr(0);
        $attr->setNum($num);
        $this->assertSame($num, $attr->getNum());

        $xml = <<<EOT
<?xml version="1.0"?>
<attr num="$num" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, NumAttr::class, 'xml'));

        $json = json_encode([
            'num' => $num,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, NumAttr::class, 'json'));
    }
}
