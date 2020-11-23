<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminZimletHostConfigInfo;
use Zimbra\Admin\Struct\AdminZimletProperty;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletHostConfigInfo.
 */
class AdminZimletHostConfigInfoTest extends ZimbraStructTestCase
{
    public function testAdminZimletHostConfigInfo()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;

        $property = new AdminZimletProperty($name, $value);

        $host = new AdminZimletHostConfigInfo($name, [$property]);
        $this->assertSame($name, $host->getName());
        $this->assertSame([$property], $host->getZimletProperties());

        $host = new AdminZimletHostConfigInfo;
        $host->setName($name)
            ->setZimletProperties([$property])
            ->addZimletProperty($property);
        $this->assertSame($name, $host->getName());
        $this->assertSame([$property, $property], $host->getZimletProperties());
        $host->setZimletProperties([$property]);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<host name="' . $name . '">'
                . '<property name="' . $name . '">' . $value. '</property>'
            . '</host>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($host, 'xml'));
        $this->assertEquals($host, $this->serializer->deserialize($xml, AdminZimletHostConfigInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'property' => [
                [
                    'name' => $name,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($host, 'json'));
        $this->assertEquals($host, $this->serializer->deserialize($json, AdminZimletHostConfigInfo::class, 'json'));
    }
}
