<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\GranteeWithType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GranteeWithType.
 */
class GranteeWithTypeTest extends ZimbraStructTestCase
{
    public function testGranteeWithType()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;
        $grantee = new GranteeWithType($type, $value);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($value, $grantee->getValue());

        $grantee = new GranteeWithType('');
        $grantee->setType($type)
               ->setValue($value);
        $this->assertSame($type, $grantee->getType());
        $this->assertSame($value, $grantee->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . $type . '">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeWithType::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeWithType::class, 'json'));
    }
}
