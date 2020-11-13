<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddAccountAliasRequest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddAccountAliasRequest.
 */
class AddAccountAliasRequestTest extends ZimbraStructTestCase
{
    public function testAddAccountAliasRequest()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;

        $req = new AddAccountAliasRequest($id, $alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req = new AddAccountAliasRequest('', '');
        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AddAccountAliasRequest::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'alias' => $alias,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AddAccountAliasRequest::class, 'json'));
    }
}
