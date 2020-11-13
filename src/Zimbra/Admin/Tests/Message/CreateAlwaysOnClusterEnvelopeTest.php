<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateAlwaysOnClusterBody;
use Zimbra\Admin\Message\CreateAlwaysOnClusterEnvelope;
use Zimbra\Admin\Message\CreateAlwaysOnClusterRequest;
use Zimbra\Admin\Message\CreateAlwaysOnClusterResponse;
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateAlwaysOnClusterEnvelope.
 */
class CreateAlwaysOnClusterEnvelopeTest extends ZimbraStructTestCase
{
    public function testCreateAlwaysOnClusterEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $cluster = new AlwaysOnClusterInfo($name, $id, [$attr]);

        $request = new CreateAlwaysOnClusterRequest(
            $name, [$attr]
        );
        $response = new CreateAlwaysOnClusterResponse($cluster);
        $body = new CreateAlwaysOnClusterBody($request, $response);

        $envelope = new CreateAlwaysOnClusterEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateAlwaysOnClusterEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateAlwaysOnClusterRequest name="' . $name . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateAlwaysOnClusterRequest>'
                    . '<urn:CreateAlwaysOnClusterResponse>'
                        . '<alwaysOnCluster name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</alwaysOnCluster>'
                    . '</urn:CreateAlwaysOnClusterResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateAlwaysOnClusterEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateAlwaysOnClusterRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateAlwaysOnClusterResponse' => [
                    'alwaysOnCluster' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateAlwaysOnClusterEnvelope::class, 'json'));
    }
}
