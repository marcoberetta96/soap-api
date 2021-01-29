<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\AddDistributionListMemberBody;
use Zimbra\Admin\Message\AddDistributionListMemberEnvelope;
use Zimbra\Admin\Message\AddDistributionListMemberRequest;
use Zimbra\Admin\Message\AddDistributionListMemberResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddDistributionListMember.
 */
class AddDistributionListMemberTest extends ZimbraTestCase
{
    public function testAddDistributionListMember()
    {
        $id = $this->faker->uuid;
        $member1 = $this->faker->name;
        $member2 = $this->faker->name;

        $request = new AddDistributionListMemberRequest($id, [$member1]);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1], $request->getMembers());

        $request = new AddDistributionListMemberRequest('');
        $request->setId($id)
            ->setMembers([$member1])
            ->addMember($member2);
        $this->assertSame($id, $request->getId());
        $this->assertSame([$member1, $member2], $request->getMembers());

        $response = new AddDistributionListMemberResponse();

        $body = new AddDistributionListMemberBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AddDistributionListMemberBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddDistributionListMemberEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AddDistributionListMemberEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:AddDistributionListMemberRequest id="$id">
            <dlm>$member1</dlm>
            <dlm>$member2</dlm>
        </urn:AddDistributionListMemberRequest>
        <urn:AddDistributionListMemberResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddDistributionListMemberEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddDistributionListMemberRequest' => [
                    'id' => $id,
                    'dlm' => [
                        [
                            '_content' => $member1,
                        ],
                        [
                            '_content' => $member2,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AddDistributionListMemberResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddDistributionListMemberEnvelope::class, 'json'));
    }
}
