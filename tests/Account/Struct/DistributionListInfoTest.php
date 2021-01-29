<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\DistributionListInfo;
use Zimbra\Account\Struct\DistributionListRightInfo;
use Zimbra\Account\Struct\DistributionListGranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListInfo.
 */
class DistributionListInfoTest extends ZimbraTestCase
{
    public function testDistributionListInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->name;
        $member1 = $this->faker->email;
        $member2 = $this->faker->email;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $owner = new DistributionListGranteeInfo(
            GranteeType::USR(), $id, $name
        );
        $right = new DistributionListRightInfo(
            $name, [$owner]
        );

        $dl = new DistributionListInfo($name, $id, [], [$member1, $member2], [$owner], [$right], FALSE, FALSE, FALSE);
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner], $dl->getOwners());
        $this->assertSame([$right], $dl->getRights());
        $this->assertFalse($dl->isOwner());
        $this->assertFalse($dl->isMember());
        $this->assertFalse($dl->isDynamic());

        $dl = new DistributionListInfo($name, $id, [new KeyValuePair($key, $value)], [], [], [], FALSE, FALSE, FALSE);
        $dl->setMembers([$member1])
            ->addMember($member2)
            ->setOwners([$owner])
            ->addOwner($owner)
            ->setRights([$right])
            ->addRight($right)
            ->setIsOwner(TRUE)
            ->setIsMember(TRUE)
            ->setDynamic(TRUE);
        $this->assertSame([$member1, $member2], $dl->getMembers());
        $this->assertSame([$owner, $owner], $dl->getOwners());
        $this->assertSame([$right, $right], $dl->getRights());
        $this->assertTrue($dl->isOwner());
        $this->assertTrue($dl->isMember());
        $this->assertTrue($dl->isDynamic());
        $dl->setOwners([$owner])->setRights([$right]);

        $xml = <<<EOT
<?xml version="1.0"?>
<dl name="$name" id="$id" isOwner="true" isMember="true" dynamic="true">
    <a n="$key">$value</a>
    <dlm>$member1</dlm>
    <dlm>$member2</dlm>
    <owners>
        <owner type="usr" id="$id" name="$name" />
    </owners>
    <rights>
        <right right="$name">
            <grantee type="usr" id="$id" name="$name" />
        </right>
    </rights>
</dl>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'isOwner' => TRUE,
            'isMember' => TRUE,
            'dynamic' => TRUE,
            'dlm' => [
                [
                    '_content' => $member1,
                ],
                [
                    '_content' => $member2,
                ],
            ],
            'owners' => [
                'owner' => [
                    [
                        'type' => 'usr',
                        'id' => $id,
                        'name' => $name,
                    ],
                ],
            ],
            'rights' => [
                'right' => [
                    [
                        'right' => $name,
                        'grantee' => [
                            [
                                'type' => 'usr',
                                'id' => $id,
                                'name' => $name,
                            ],
                        ],
                    ],
                ],
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListInfo::class, 'json'));
    }
}
