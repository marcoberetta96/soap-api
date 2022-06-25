<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CalendarResourceInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarResourceInfo.
 */
class CalendarResourceInfoTest extends ZimbraTestCase
{
    public function testCalendarResourceInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);

        $info = new CalendarResourceInfo($name, $id, [$attr1]);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1], $info->getAttrList());

        $info = new CalendarResourceInfo('', '');
        $info->setName($name)
             ->setId($id)
             ->setAttrList([$attr1])
             ->addAttr($attr2);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1, $attr2], $info->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id">
    <a n="$key1">$value1</a>
    <a n="$key2">$value2</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, CalendarResourceInfo::class, 'xml'));
    }
}
