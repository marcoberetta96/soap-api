<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveRightsTargetSelector.
 */
class EffectiveRightsTargetSelectorTest extends ZimbraStructTestCase
{
    public function testEffectiveRightsTargetSelector()
    {
        $value = $this->faker->word;
        $target = new EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), TargetBy::ID(), $value
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertEquals(TargetBy::ID(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $target = new EffectiveRightsTargetSelector(TargetType::DOMAIN(), TargetBy::ID());
        $target->setType(TargetType::ACCOUNT())
               ->setBy(TargetBy::NAME())
               ->setValue($value);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertEquals(TargetBy::NAME(), $target->getBy());
        $this->assertSame($value, $target->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, EffectiveRightsTargetSelector::class, 'xml'));

        $json = json_encode([
            'type' => (string) TargetType::ACCOUNT(),
            'by' => (string) TargetBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, EffectiveRightsTargetSelector::class, 'json'));
    }
}
