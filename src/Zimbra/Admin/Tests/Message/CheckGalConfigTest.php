<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckGalConfigBody;
use Zimbra\Admin\Message\CheckGalConfigEnvelope;
use Zimbra\Admin\Message\CheckGalConfigRequest;
use Zimbra\Admin\Message\CheckGalConfigResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\LimitedQuery;

use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckGalConfig.
 */
class CheckGalConfigTest extends ZimbraStructTestCase
{
    public function testCheckGalConfig()
    {
        $limit = mt_rand(0, 10);
        $id = $this->faker->uuid;
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $query = new LimitedQuery($limit, $value);
        $request = new CheckGalConfigRequest($query, $action, [new Attr($key, $value)]);
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($action, $request->getAction());

        $request = new CheckGalConfigRequest(new LimitedQuery(0, ''), '', [new Attr($key, $value)]);
        $request->setQuery($query)
            ->setAction($action);
        $this->assertSame($query, $request->getQuery());
        $this->assertSame($action, $request->getAction());

        $cn = new GalContactInfo($id, [new Attr($key, $value)]);
        $response = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $this->assertSame([$cn], $response->getGalContacts());

        $response = new CheckGalConfigResponse('', '');
        $response->setCode($code)
            ->setMessage($message)
            ->setGalContacts([$cn])
            ->addGalContact($cn);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());
        $this->assertSame([$cn, $cn], $response->getGalContacts());
        $response->setGalContacts([$cn]);

        $body = new CheckGalConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckGalConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckGalConfigEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckGalConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckGalConfigRequest>'
                        . '<query limit="' . $limit . '">' . $value . '</query>'
                        . '<action>' . $action . '</action>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CheckGalConfigRequest>'
                    . '<urn:CheckGalConfigResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                        . '<cn id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</cn>'
                    . '</urn:CheckGalConfigResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckGalConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckGalConfigRequest' => [
                    'query' => [
                        'limit' => $limit,
                        '_content' => $value,
                    ],
                    'action' => [
                        '_content' => $action,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckGalConfigResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    'cn' => [
                        [
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                            'id' => $id,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckGalConfigEnvelope::class, 'json'));
    }
}
