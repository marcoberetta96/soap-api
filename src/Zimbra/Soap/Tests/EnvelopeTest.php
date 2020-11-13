<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Enum\{AccountBy, RequestFormat};
use Zimbra\Soap\{Envelope, Header, Body, BodyInterface, RequestInterface, ResponseInterface};
use Zimbra\Soap\Header\{AccountInfo, Context, ChangeInfo, FormatInfo, NotifyInfo, SessionInfo, UserAgentInfo};
use Zimbra\Struct\AuthTokenControl;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for Envelope.
 */
class EnvelopeTest extends ZimbraStructTestCase
{
    public function testSoapEnvelope()
    {
        $id = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $sequence = mt_rand(1, 100);
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;
        $version = $this->faker->word;

        $hopCount = mt_rand(1, 100);
        $authToken = $this->faker->uuid;
        $noSession = $this->faker->word;
        $targetServer = $this->faker->word;
        $noNotify = $this->faker->word;
        $noQualify = $this->faker->word;
        $via = $this->faker->word;
        $soapRequestId = $this->faker->word;
        $csrfToken = $this->faker->uuid;

        $session = new SessionInfo(TRUE, $id, $sequence, $value);
        $legacySessionId = new SessionInfo(FALSE, $id, $sequence, $value);
        $account = new AccountInfo(AccountBy::ID(), TRUE, $value);
        $change = new ChangeInfo($changeId, $changeType);
        $userAgent = new UserAgentInfo($name, $version);
        $authTokenControl = new AuthTokenControl(TRUE);
        $format = new FormatInfo(RequestFormat::XML());
        $notify = new NotifyInfo($sequence);
        $context = new Context(
            $hopCount,
            $authToken,
            $session,
            $legacySessionId,
            $noSession,
            $account,
            $change,
            $targetServer,
            $userAgent,
            $authTokenControl,
            $format,
            $notify,
            $noNotify,
            $noQualify,
            $via,
            $soapRequestId,
            $csrfToken
        );
        $header = new Header($context);
        $body = new FooBody();
        $envelope = new FooEnvelope($header, $body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FooEnvelope();
        $envelope->setHeader($header)->setBody($body);
        $this->assertSame($header, $envelope->getHeader());
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
                . '<soap:Header xmlns:urn="urn:zimbra">'
                    . '<urn:context hops="' . $hopCount . '" >'
                        . '<authToken>' . $authToken . '</authToken>'
                        . '<session proxy="true" id="' . $id . '" seq="' . $sequence . '">' . $value . '</session>'
                        . '<sessionId proxy="false" id="' . $id . '" seq="' . $sequence . '">' . $value . '</sessionId>'
                        . '<nosession>' . $noSession . '</nosession>'
                        . '<account by="' . AccountBy::ID() . '" link="true">' . $value . '</account>'
                        . '<change token="' . $changeId . '" type="' . $changeType . '"/>'
                        . '<targetServer>' . $targetServer . '</targetServer>'
                        . '<userAgent name="' . $name . '" version="' . $version . '"/>'
                        . '<authTokenControl voidOnExpired="true"/>'
                        . '<format type="' . RequestFormat::XML() . '"/>'
                        . '<notify seq="' . $sequence . '"/>'
                        . '<nonotify>' . $noNotify . '</nonotify>'
                        . '<noqualify>' . $noQualify . '</noqualify>'
                        . '<via>' . $via . '</via>'
                        . '<soapId>' . $soapRequestId . '</soapId>'
                        . '<csrfToken>' . $csrfToken . '</csrfToken>'
                    . '</urn:context>'
                . '</soap:Header>'
                . '<soap:Body/>'
            . '</soap:Envelope>';

        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FooEnvelope::class, 'xml'));

        $json = json_encode([
            'Header' => [
                'context' => [
                    'hops' => $hopCount,
                    'authToken' => [
                        '_content' => $authToken,
                    ],
                    'session' => [
                        'proxy' => TRUE,
                        'id' => $id,
                        'seq' => $sequence,
                        '_content' => $value,
                    ],
                    'sessionId' => [
                        'proxy' => FALSE,
                        'id' => $id,
                        'seq' => $sequence,
                        '_content' => $value,
                    ],
                    'nosession' => [
                        '_content' => $noSession,
                    ],
                    'account' => [
                        'by' => (string) AccountBy::ID(),
                        'link' => TRUE,
                        '_content' => $value,
                    ],
                    'change' => [
                        'token' => $changeId,
                        'type' => $changeType,
                    ],
                    'targetServer' => [
                        '_content' => $targetServer,
                    ],
                    'userAgent' => [
                        'name' => $name,
                        'version' => $version,
                    ],
                    'authTokenControl' => [
                        'voidOnExpired' => TRUE,
                    ],
                    'format' => [
                        'type' => (string) RequestFormat::XML(),
                    ],
                    'notify' => [
                        'seq' => $sequence,
                    ],
                    'nonotify' => [
                        '_content' => $noNotify,
                    ],
                    'noqualify' => [
                        '_content' => $noQualify,
                    ],
                    'via' => [
                        '_content' => $via,
                    ],
                    'soapId' => [
                        '_content' => $soapRequestId,
                    ],
                    'csrfToken' => [
                        '_content' => $csrfToken,
                    ],
                    '_jsns' => 'urn:zimbra',
                ],
            ],
            'Body' => new \stdClass(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, FooEnvelope::class, 'json'));
    }
}

/**
 * @XmlRoot(name="soap:Envelope")
 */
class FooEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Soap\Tests\FooBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $_body;

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody() : BodyInterface
    {
        return $this->_body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body): Envelope
    {
        $this->_body = $body;
        return $this;
    }
}

class FooBody extends Body
{
    public function setRequest(RequestInterface $request): self
    {}

    public function getRequest(): ?RequestInterface
    {}

    public function setResponse(ResponseInterface $response): self
    {}

    public function getResponse(): ?ResponseInterface
    {}
}
