<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\CalTZInfo;
use Zimbra\Admin\Struct\TzReplaceInfo;
use Zimbra\Common\Struct\TzOnsetInfo;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TzReplaceInfo.
 */
class TzReplaceInfoTest extends ZimbraTestCase
{
    public function testTzReplaceInfo()
    {
        $id = $this->faker->word;
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new Id($id);
        $standard = new TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new CalTZInfo($id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname);

        $replace = new TzReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $replace = new TzReplaceInfo();
        $replace->setWellKnownTz($wellKnownTz)
                ->setCalTz($tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getCalTz());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <wellKnownTz id="$id" />
    <tz id="$id" stdoff="$stdoff" dayoff="$dayoff" stdname="$stdname" dayname="$dayname">
        <standard mon="$mon" hour="$hour" min="$min" sec="$sec" />
        <daylight mon="$mon" hour="$hour" min="$min" sec="$sec" />
    </tz>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($replace, 'xml'));
        $this->assertEquals($replace, $this->serializer->deserialize($xml, TzReplaceInfo::class, 'xml'));

        $json = json_encode([
            'wellKnownTz' => [
                'id' => $id,
            ],
            'tz' => [
                'id' => $id,
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'stdname' => $stdname,
                'dayname' => $dayname,
                'standard' => [
                    'mon' => $mon,
                    'hour' => $hour,
                    'min' => $min,
                    'sec' => $sec,
                ],
                'daylight' => [
                    'mon' => $mon,
                    'hour' => $hour,
                    'min' => $min,
                    'sec' => $sec,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($replace, 'json'));
        $this->assertEquals($replace, $this->serializer->deserialize($json, TzReplaceInfo::class, 'json'));
    }
}
