<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AccountSessionInfo;
use Zimbra\Admin\Struct\SessionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AccountSessionInfo.
 */
class AccountSessionInfoTest extends ZimbraTestCase
{
    public function testAccountSessionInfo()
    {
        $sessionId = $this->faker->uuid;
        $createdDate = mt_rand(1, 1000);
        $lastAccessedDate = mt_rand(1, 1000);
        $zimbraId = $this->faker->uuid;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $session = new SessionInfo(
            $sessionId, $createdDate, $lastAccessedDate, $zimbraId, $name
        );

        $info = new AccountSessionInfo($name, $id, [$session]);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$session], $info->getSessions());

        $info = new AccountSessionInfo('', '');
        $info->setName($name)
            ->setId($id)
            ->setSessions([$session])
            ->addSession($session);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$session, $session], $info->getSessions());
        $info->setSessions([$session]);

        $xml = <<<EOT
<?xml version="1.0"?>
<info name="$name" id="$id">
    <s zid="$zimbraId" name="$name" sid="$sessionId" cd="$createdDate" ld="$lastAccessedDate" />
</info>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, AccountSessionInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            's' => [
                [
                    'zid' => $zimbraId,
                    'name' => $name,
                    'sid' => $sessionId,
                    'cd' => $createdDate,
                    'ld' => $lastAccessedDate,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, AccountSessionInfo::class, 'json'));
    }
}
