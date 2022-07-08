<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\InvalidateReminderDeviceEnvelope;
use Zimbra\Mail\Message\InvalidateReminderDeviceBody;
use Zimbra\Mail\Message\InvalidateReminderDeviceRequest;
use Zimbra\Mail\Message\InvalidateReminderDeviceResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InvalidateReminderDevice.
 */
class InvalidateReminderDeviceTest extends ZimbraTestCase
{
    public function testInvalidateReminderDevice()
    {
        $address = $this->faker->email;

        $request = new InvalidateReminderDeviceRequest($address);
        $this->assertSame($address, $request->getAddress());
        $request = new InvalidateReminderDeviceRequest();
        $request->setAddress($address);
        $this->assertSame($address, $request->getAddress());
        $response = new InvalidateReminderDeviceResponse();

        $body = new InvalidateReminderDeviceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new InvalidateReminderDeviceBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new InvalidateReminderDeviceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new InvalidateReminderDeviceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:InvalidateReminderDeviceRequest a="$address" />
        <urn:InvalidateReminderDeviceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, InvalidateReminderDeviceEnvelope::class, 'xml'));
    }
}
