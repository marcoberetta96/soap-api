<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\BulkTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BulkTest.
 */
class BulkTestTest extends ZimbraStructTestCase
{
    public function testBulkTest()
    {
        $index = mt_rand(1, 99);

        $test = new BulkTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<bulkTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, BulkTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, BulkTest::class, 'json'));
    }
}
