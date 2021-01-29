<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddressBookTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddressBookTest.
 */
class AddressBookTestTest extends ZimbraTestCase
{
    public function testAddressBookTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;

        $test = new AddressBookTest(
            $index, TRUE, $header
        );
        $this->assertSame($header, $test->getHeader());

        $test = new AddressBookTest($index, TRUE);
        $test->setHeader($header);
        $this->assertSame($header, $test->getHeader());

        $xml = <<<EOT
<?xml version="1.0"?>
<addressBookTest index="$index" negative="true" header="$header" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, AddressBookTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, AddressBookTest::class, 'json'));
    }
}
