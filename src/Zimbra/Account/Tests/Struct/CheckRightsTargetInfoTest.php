<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsRightInfo;
use Zimbra\Account\Struct\CheckRightsTargetInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsTargetInfo.
 */
class CheckRightsTargetInfoTest extends ZimbraStructTestCase
{
    public function testCheckRightsTargetInfo()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $rightInfo1 = new CheckRightsRightInfo($right1, TRUE);
        $rightInfo2 = new CheckRightsRightInfo($right2, FALSE);

        $target = new CheckRightsTargetInfo(
            TargetType::DOMAIN(), TargetBy::ID(), $key, FALSE, [$rightInfo1]
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getTargetType());
        $this->assertEquals(TargetBy::ID(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertFalse($target->getAllow());
        $this->assertSame([$rightInfo1], $target->getRights());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->setAllow(TRUE)
               ->addRight($rightInfo2);

        $this->assertEquals(TargetType::ACCOUNT(), $target->getTargetType());
        $this->assertEquals(TargetBy::NAME(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertTrue($target->getAllow());
        $this->assertSame([$rightInfo1, $rightInfo2], $target->getRights());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key . '" allow="true">'
                . '<right allow="true">' . $right1 . '</right>'
                . '<right allow="false">' . $right2 . '</right>'
            . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, CheckRightsTargetInfo::class, 'xml'));

        $json = json_encode([
            'type' => TargetType::ACCOUNT(),
            'by' => TargetBy::NAME(),
            'key' => $key,
            'allow' => TRUE,
            'right' => [
                [
                    '_content' => $right1,
                    'allow' => TRUE,
                ],
                [
                    '_content' => $right2,
                    'allow' => FALSE,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, CheckRightsTargetInfo::class, 'json'));
    }
}
