<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\CacheEntrySelector;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CacheEntrySelector.
 */
class CacheEntrySelectorTest extends ZimbraStructTestCase
{
    public function testCacheEntrySelector()
    {
        $value = $this->faker->word;

        $entry = new CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $this->assertEquals(CacheEntryBy::NAME(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $entry = new CacheEntrySelector(CacheEntryBy::NAME());
        $entry->setBy(CacheEntryBy::ID())
            ->setValue($value);
        $this->assertEquals(CacheEntryBy::ID(), $entry->getBy());
        $this->assertSame($value, $entry->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<entry by="' . CacheEntryBy::ID() . '">' . $value . '</entry>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entry, 'xml'));
        $this->assertEquals($entry, $this->serializer->deserialize($xml, CacheEntrySelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) CacheEntryBy::ID(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($entry, 'json'));
        $this->assertEquals($entry, $this->serializer->deserialize($json, CacheEntrySelector::class, 'json'));
    }
}
