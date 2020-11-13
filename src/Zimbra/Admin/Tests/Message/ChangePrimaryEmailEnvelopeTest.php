<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ChangePrimaryEmailBody;
use Zimbra\Admin\Message\ChangePrimaryEmailEnvelope;
use Zimbra\Admin\Message\ChangePrimaryEmailRequest;
use Zimbra\Admin\Message\ChangePrimaryEmailResponse;
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\AccountBy;
use Zimbra\Struct\AccountSelector;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangePrimaryEmailEnvelope.
 */
class ChangePrimaryEmailEnvelopeTest extends ZimbraStructTestCase
{
    public function testChangePrimaryEmailBody()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $newName = $this->faker->word;

        $account = new AccountSelector(AccountBy::NAME(), $name);
        $attr = new Attr($key, $value);
        $AccountInfo = new AccountInfo($name, $id, TRUE, [$attr]);

        $request = new ChangePrimaryEmailRequest(
            $account, $newName
        );
        $response = new ChangePrimaryEmailResponse($AccountInfo);
        $body = new ChangePrimaryEmailBody($request, $response);

        $envelope = new ChangePrimaryEmailEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ChangePrimaryEmailEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ChangePrimaryEmailRequest>'
                        . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                        . '<newName>' . $newName . '</newName>'
                    . '</urn:ChangePrimaryEmailRequest>'
                    . '<urn:ChangePrimaryEmailResponse>'
                        . '<account name="' . $name . '" id="' . $id . '" isExternal="true">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</account>'
                    . '</urn:ChangePrimaryEmailResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ChangePrimaryEmailEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ChangePrimaryEmailRequest' => [
                    'account' => [
                        'by' => (string) AccountBy::NAME(),
                        '_content' => $name,
                    ],
                    'newName' => [
                        '_content' => $newName,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ChangePrimaryEmailResponse' => [
                    'account' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'isExternal' => TRUE,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ChangePrimaryEmailEnvelope::class, 'json'));
    }
}
