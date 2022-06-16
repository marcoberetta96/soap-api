<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetContactBackupListEnvelope;
use Zimbra\Mail\Message\GetContactBackupListBody;
use Zimbra\Mail\Message\GetContactBackupListRequest;
use Zimbra\Mail\Message\GetContactBackupListResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetContactBackupList.
 */
class GetContactBackupListTest extends ZimbraTestCase
{
    public function testGetContactBackupList()
    {
        $backup1 = $this->faker->email;
        $backup2 = $this->faker->email;

        $request = new GetContactBackupListRequest();
        $response = new GetContactBackupListResponse([$backup1, $backup2]);
        $this->assertSame([$backup1, $backup2], $response->getBackup());
        $response = new GetContactBackupListResponse();
        $response->setBackup([$backup1])
            ->addBackup($backup2);

        $body = new GetContactBackupListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetContactBackupListBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetContactBackupListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetContactBackupListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetContactBackupListRequest />
        <urn:GetContactBackupListResponse>
            <backups>
                <backup>$backup1</backup>
                <backup>$backup2</backup>
            </backups>
        </urn:GetContactBackupListResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetContactBackupListEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetContactBackupListRequest' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
                'GetContactBackupListResponse' => [
                    'backups' => [
                        'backup' => [
                            [
                                '_content' => $backup1,
                            ],
                            [
                                '_content' => $backup2,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetContactBackupListEnvelope::class, 'json'));
    }
}
