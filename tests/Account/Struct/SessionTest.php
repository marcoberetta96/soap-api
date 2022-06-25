<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\Session;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Session.
 */
class SessionTest extends ZimbraTestCase
{
    public function testProp()
    {
        $type = $this->faker->word;
        $id = $this->faker->uuid;

        $session = new Session($id, $type);
        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());

        $session = new Session('', '');
        $session->setType($type)
             ->setId($id)
             ->setValue($id);
        $this->assertSame($type, $session->getType());
        $this->assertSame($id, $session->getId());
        $this->assertSame($id, $session->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" id="$id">$id</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($session, 'xml'));
        $this->assertEquals($session, $this->serializer->deserialize($xml, Session::class, 'xml'));
    }
}
