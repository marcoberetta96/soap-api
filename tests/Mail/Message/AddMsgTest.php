<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AddressType;
use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Message\AddMsgEnvelope;
use Zimbra\Mail\Message\AddMsgBody;
use Zimbra\Mail\Message\AddMsgRequest;
use Zimbra\Mail\Message\AddMsgResponse;

use Zimbra\Mail\Struct\AddMsgSpec;
use Zimbra\Mail\Struct\EmailInfo;
use Zimbra\Mail\Struct\InviteInfo;
use Zimbra\Mail\Struct\ChatSummary;
use Zimbra\Mail\Struct\MessageSummary;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddMsg.
 */
class AddMsgTest extends ZimbraTestCase
{
    public function testAddMsg()
    {
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $folder = $this->faker->word;
        $dateReceived = time();
        $attachmentId = $this->faker->uuid;
        $content = $this->faker->text;

        $msg = new AddMsgSpec($flags, $tags, $tagNames, $folder, TRUE, $dateReceived, $attachmentId, $content);
        $request = new AddMsgRequest($msg, FALSE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertFalse($request->getFilterSent());
        $request = new AddMsgRequest(new AddMsgSpec());
        $request->setMsg($msg)
            ->setFilterSent(TRUE);
        $this->assertSame($msg, $request->getMsg());
        $this->assertTrue($request->getFilterSent());

        $id = $this->faker->uuid;
        $autoSendTime = $this->faker->unixTime;
        $subject = $this->faker->text;
        $fragment = $this->faker->text;

        $address = $this->faker->email;
        $display = $this->faker->name;
        $personal = $this->faker->word;
        $addressType = AddressType::TO();
        $calItemType = InviteType::TASK();

        $email = new EmailInfo($address, $display, $personal, $addressType);
        $msg = new MessageSummary($id, $autoSendTime, [$email], $subject, $fragment, new InviteInfo($calItemType));
        $chat = new ChatSummary($id, $autoSendTime, [$email], $subject, $fragment, new InviteInfo($calItemType));

        $response = new AddMsgResponse($msg);
        $this->assertSame($msg, $response->getMessage());
        $this->assertNull($response->getChatMessage());

        $response = new AddMsgResponse($chat);
        $this->assertSame($chat, $response->getChatMessage());
        $this->assertNull($response->getMessage());

        $response = new AddMsgResponse();
        $response->setMessage($msg);
        $this->assertSame($msg, $response->getMessage());
        $this->assertNull($response->getChatMessage());
        $response->setMessage($chat);
        $this->assertSame($chat, $response->getChatMessage());
        $this->assertNull($response->getMessage());

        $body = new AddMsgBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AddMsgBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddMsgEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AddMsgEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddMsgRequest filterSent="true">
            <m f="$flags" t="$tags" tn="$tagNames" l="$folder" noICal="true" d="$dateReceived" aid="$attachmentId">
                <content>$content</content>
            </m>
        </urn:AddMsgRequest>
        <urn:AddMsgResponse>
            <chat id="$id" autoSendTime="$autoSendTime">
                <e a="$address" d="$display" p="$personal" t="t" />
                <su>$subject</su>
                <fr>$fragment</fr>
                <inv type="task" />
            </chat>
        </urn:AddMsgResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddMsgEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AddMsgRequest' => [
                    'filterSent' => TRUE,
                    'm' => [
                        'f' => $flags,
                        't' => $tags,
                        'tn' => $tagNames,
                        'l' => $folder,
                        'noICal' => TRUE,
                        'd' => $dateReceived,
                        'aid' => $attachmentId,
                        'content' => [
                            '_content' => $content,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'AddMsgResponse' => [
                    'chat' => [
                        'id' => $id,
                        'autoSendTime' => $autoSendTime,
                        'e' => [
                            [
                                'a' => $address,
                                'd' => $display,
                                'p' => $personal,
                                't' => 't',
                            ],
                        ],
                        'su' => [
                            '_content' => $subject,
                        ],
                        'fr' => [
                            '_content' => $fragment,
                        ],
                        'inv' => [
                            'type' => 'task',
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AddMsgEnvelope::class, 'json'));
    }
}
