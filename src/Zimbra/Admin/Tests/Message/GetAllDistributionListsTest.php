<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllDistributionListsBody;
use Zimbra\Admin\Message\GetAllDistributionListsEnvelope;
use Zimbra\Admin\Message\GetAllDistributionListsRequest;
use Zimbra\Admin\Message\GetAllDistributionListsResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\GranteeType;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllDistributionLists.
 */
class GetAllDistributionListsTest extends ZimbraStructTestCase
{
    public function testGetAllDistributionLists()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $member = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $attr = new Attr($key, $value);
        $owner = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $dl = new DistributionListInfo($name, $id, [$member], [$attr], [$owner], TRUE);

        $request = new GetAllDistributionListsRequest($domain);
        $this->assertSame($domain, $request->getDomain());

        $request = new GetAllDistributionListsRequest();
        $request->setDomain($domain);
        $this->assertSame($domain, $request->getDomain());

        $response = new GetAllDistributionListsResponse([$dl]);
        $this->assertSame([$dl], $response->getDls());
        $response = new GetAllDistributionListsResponse();
        $response->setDls([$dl])
            ->addDl($dl);
        $this->assertSame([$dl, $dl], $response->getDls());
        $response->setDls([$dl]);

        $body = new GetAllDistributionListsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetAllDistributionListsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllDistributionListsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetAllDistributionListsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllDistributionListsRequest>'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '</urn:GetAllDistributionListsRequest>'
                    . '<urn:GetAllDistributionListsResponse>'
                        . '<dl name="' . $name . '" id="' . $id . '" dynamic="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                            . '<dlm>' . $member . '</dlm>'
                            . '<owners>'
                                . '<owner id="' . $id . '" name="' . $name . '" type="' . GranteeType::ALL() . '" />'
                            . '</owners>'
                        . '</dl>'
                    . '</urn:GetAllDistributionListsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllDistributionListsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllDistributionListsRequest' => [
                    'domain' => [
                        'by' => (string) DomainBy::NAME(),
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllDistributionListsResponse' => [
                    'dl' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'dynamic' => TRUE,
                            'dlm' => [
                                ['_content' => $member],
                            ],
                            'owners' => [
                                'owner' => [
                                    [
                                        'id' => $id,
                                        'name' => $name,
                                        'type' => (string) GranteeType::ALL(),
                                    ],
                                ],
                            ],
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllDistributionListsEnvelope::class, 'json'));
    }
}
