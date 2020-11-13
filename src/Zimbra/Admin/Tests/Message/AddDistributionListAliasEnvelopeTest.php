<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AddDistributionListAliasBody;
use Zimbra\Admin\Message\AddDistributionListAliasEnvelope;
use Zimbra\Admin\Message\AddDistributionListAliasRequest;
use Zimbra\Admin\Message\AddDistributionListAliasResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddDistributionListAliasEnvelope.
 */
class AddDistributionListAliasEnvelopeTest extends ZimbraStructTestCase
{
    public function testAddDistributionListAliasEnvelope()
    {
        $id = $this->faker->uuid;
        $alias = $this->faker->word;
        $request = new AddDistributionListAliasRequest($id, $alias);
        $response = new AddDistributionListAliasResponse();
        $body = new AddDistributionListAliasBody($request, $response);

        $envelope = new AddDistributionListAliasEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListAliasEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                	. '<urn:AddDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                    . '<urn:AddDistributionListAliasResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListAliasEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddDistributionListAliasRequest' => [
                    'id' => $id,
                    'alias' => $alias,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddDistributionListAliasResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddDistributionListAliasEnvelope::class, 'json'));
    }
}
