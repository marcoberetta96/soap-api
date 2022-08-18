<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\{Channel, RecoverAccountOperation};

use Zimbra\Mail\Message\RecoverAccountEnvelope;
use Zimbra\Mail\Message\RecoverAccountBody;
use Zimbra\Mail\Message\RecoverAccountRequest;
use Zimbra\Mail\Message\RecoverAccountResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RecoverAccount.
 */
class RecoverAccountTest extends ZimbraTestCase
{
    public function testRecoverAccount()
    {
        $channel = Channel::EMAIL;
        $op = RecoverAccountOperation::GET_RECOVERY_ACCOUNT;
        $email = $this->faker->email;
        $recoveryAccount = $this->faker->email;
        $recoveryAttemptsLeft = $this->faker->randomNumber;

        $request = new RecoverAccountRequest($email, $op, $channel);
        $this->assertSame($op, $request->getOp());
        $this->assertSame($email, $request->getEmail());
        $this->assertSame($channel, $request->getChannel());
        $request = new RecoverAccountRequest();
        $request->setOp($op)
            ->setEmail($email)
            ->setChannel($channel);
        $this->assertSame($op, $request->getOp());
        $this->assertSame($email, $request->getEmail());
        $this->assertSame($channel, $request->getChannel());

        $response = new RecoverAccountResponse($recoveryAccount, $recoveryAttemptsLeft);
        $this->assertSame($recoveryAccount, $response->getRecoveryAccount());
        $this->assertSame($recoveryAttemptsLeft, $response->getRecoveryAttemptsLeft());
        $response = new RecoverAccountResponse();
        $response->setRecoveryAccount($recoveryAccount)
            ->setRecoveryAttemptsLeft($recoveryAttemptsLeft);
        $this->assertSame($recoveryAccount, $response->getRecoveryAccount());
        $this->assertSame($recoveryAttemptsLeft, $response->getRecoveryAttemptsLeft());

        $body = new RecoverAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RecoverAccountBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RecoverAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RecoverAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RecoverAccountRequest op="getRecoveryAccount" email="$email" channel="email" />
        <urn:RecoverAccountResponse recoveryAccount="$recoveryAccount" recoveryAttemptsLeft="$recoveryAttemptsLeft" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RecoverAccountEnvelope::class, 'xml'));
    }
}
