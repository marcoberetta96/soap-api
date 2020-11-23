<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ZimletServerExtension;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZimletServerExtension.
 */
class ZimletServerExtensionTest extends ZimbraStructTestCase
{
    public function testZimletServerExtension()
    {
        $hasKeyword = $this->faker->word;
        $extensionClass = $this->faker->word;
        $regex = $this->faker->word;

        $serverExtension = new ZimletServerExtension(
            $hasKeyword, $extensionClass, $regex
        );
        $this->assertSame($hasKeyword, $serverExtension->getHasKeyword());
        $this->assertSame($extensionClass, $serverExtension->getExtensionClass());
        $this->assertSame($regex, $serverExtension->getRegex());

        $serverExtension = new ZimletServerExtension();
        $serverExtension->setHasKeyword($hasKeyword)
            ->setExtensionClass($extensionClass)
            ->setRegex($regex);
        $this->assertSame($hasKeyword, $serverExtension->getHasKeyword());
        $this->assertSame($extensionClass, $serverExtension->getExtensionClass());
        $this->assertSame($regex, $serverExtension->getRegex());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<serverExtension hasKeyword="' . $hasKeyword . '" extensionClass="' . $extensionClass . '" regex="' . $regex . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($serverExtension, 'xml'));
        $this->assertEquals($serverExtension, $this->serializer->deserialize($xml, ZimletServerExtension::class, 'xml'));

        $json = json_encode([
            'hasKeyword' => $hasKeyword,
            'extensionClass' => $extensionClass,
            'regex' => $regex,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($serverExtension, 'json'));
        $this->assertEquals($serverExtension, $this->serializer->deserialize($json, ZimletServerExtension::class, 'json'));
    }
}
