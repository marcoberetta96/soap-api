<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\BlackList;
use Zimbra\Struct\OpValue;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for BlackList.
 */
class BlackListTest extends ZimbraStructTestCase
{
    public function testBlackList()
    {
        $value1 = $this->faker->word;
        $addr1 = new OpValue('+', $value1);

        $blackList = new BlackList([$addr1]);
        $this->assertSame([$addr1], $blackList->getAddrs());

        $value2 = $this->faker->word;
        $addr2 = new OpValue('-', $value2);

        $blackList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $blackList->getAddrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<blackList>'
                . '<addr op="+">' . $value1 . '</addr>'
                . '<addr op="-">' . $value2 . '</addr>'
            . '</blackList>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blackList, 'xml'));
        $this->assertEquals($blackList, $this->serializer->deserialize($xml, BlackList::class, 'xml'));

        $json = json_encode([
            'addr' => [
                [
                    'op' => '+',
                    '_content' => $value1,
                ],
                [
                    'op' => '-',
                    '_content' => $value2,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($blackList, 'json'));
        $this->assertEquals($blackList, $this->serializer->deserialize($json, BlackList::class, 'json'));
    }
}
