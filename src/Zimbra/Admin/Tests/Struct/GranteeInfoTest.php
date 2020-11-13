<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GranteeInfo.
 */
class GranteeInfoTest extends ZimbraStructTestCase
{
    public function testGranteeInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $grantee = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertEquals(GranteeType::ALL(), $grantee->getType());

        $grantee = new GranteeInfo('', '');
        $grantee->setId($id)
                ->setName($name)
                ->setType(GranteeType::USR());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertEquals(GranteeType::USR(), $grantee->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee id="' . $id . '" name="' . $name . '" type="' . GranteeType::USR() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'type' => (string) GranteeType::USR(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeInfo::class, 'json'));
    }
}
