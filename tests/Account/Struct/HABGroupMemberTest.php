<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\HABGroupMember;
use Zimbra\Common\Struct\NamedValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HABGroupMember.
 */
class HABGroupMemberTest extends ZimbraTestCase
{
    public function testHABGroupMember()
    {
        $name = $this->faker->email;
        $seniorityIndex = mt_rand(1, 100);

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new NamedValue($key1, $value1);
        $attr2 = new NamedValue($key2, $value2);

        $groupMember = new HABGroupMember($name, $seniorityIndex, [$attr1]);
        $this->assertSame([$attr1], $groupMember->getAttrs());
        $groupMember->setAttrs([$attr1])->addAttr($attr2);
        $this->assertSame([$attr1, $attr2], $groupMember->getAttrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seniorityIndex="$seniorityIndex">
    <name>$name</name>
    <attr name="$key1">$value1</attr>
    <attr name="$key2">$value2</attr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($groupMember, 'xml'));
        $this->assertEquals($groupMember, $this->serializer->deserialize($xml, HABGroupMember::class, 'xml'));
    }
}
