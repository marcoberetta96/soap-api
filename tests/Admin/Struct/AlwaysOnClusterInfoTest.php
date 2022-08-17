<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AlwaysOnClusterInfo.
 */
class AlwaysOnClusterInfoTest extends ZimbraTestCase
{
    public function testAlwaysOnClusterInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new Attr($key1, $value1);
        $attr2 = new Attr($key2, $value2);

        $info = new StubAlwaysOnClusterInfo($name, $id, [$attr1]);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1], $info->getAttrList());

        $info = new StubAlwaysOnClusterInfo();
        $info->setName($name)
             ->setId($id)
             ->setAttrList([$attr1, $attr2]);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1, $attr2], $info->getAttrList());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, StubAlwaysOnClusterInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubAlwaysOnClusterInfo extends AlwaysOnClusterInfo
{
}
