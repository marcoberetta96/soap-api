<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Enum\AclType;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZimletAclStatusPri.
 */
class ZimletAclStatusPriTest extends ZimbraStructTestCase
{
    public function testZimletAclStatusPri()
    {
        $name = $this->faker->word;
        $cos = $this->faker->word;
        $value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::DENY());
        $status = new ValueAttrib(ZimletStatus::ENABLED()->getValue());
        $priority = new IntegerValueAttrib($value);

        $zimlet = new ZimletAclStatusPri($name, $acl, $status, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet = new ZimletAclStatusPri('');
        $zimlet->setName($name)
               ->setAcl($acl)
               ->setStatus($status)
               ->setPriority($priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '">'
                . '<acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                . '<status value="' . ZimletStatus::ENABLED() . '" />'
                . '<priority value="' . $value . '" />'
            . '</zimlet>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ZimletAclStatusPri::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'acl' => [
                'cos' => $cos,
                'acl' => (string) AclType::DENY(),
            ],
            'status' => [
                'value' => (string) ZimletStatus::ENABLED(),
            ],
            'priority' => [
                'value' => $value,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, ZimletAclStatusPri::class, 'json'));
    }
}
