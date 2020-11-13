<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SyncGalAccountDataSourceSpec.
 */
class SyncGalAccountDataSourceSpecTest extends ZimbraStructTestCase
{
    public function testSyncGalAccountDataSourceSpec()
    {
        $value = $this->faker->word;

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID(), $value, FALSE, TRUE);
        $this->assertEquals(DataSourceBy::ID(), $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertFalse($ds->getFullSync());
        $this->assertTrue($ds->getReset());

        $ds = new SyncGalAccountDataSourceSpec(DataSourceBy::ID(), '', FALSE, TRUE);
        $ds->setBy(DataSourceBy::NAME())
           ->setValue($value)
           ->setFullSync(TRUE)
           ->setReset(FALSE);
        $this->assertEquals(DataSourceBy::NAME(), $ds->getBy());
        $this->assertSame($value, $ds->getValue());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="true" reset="false">' . $value . '</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ds, 'xml'));
        $this->assertEquals($ds, $this->serializer->deserialize($xml, SyncGalAccountDataSourceSpec::class, 'xml'));

        $json = json_encode([
            'by' => (string) DataSourceBy::NAME(),
            'fullSync' => TRUE,
            'reset' => FALSE,
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($ds, 'json'));
        $this->assertEquals($ds, $this->serializer->deserialize($json, SyncGalAccountDataSourceSpec::class, 'json'));
    }
}
