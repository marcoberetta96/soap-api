<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ImapMessageInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ImapMessageInfo.
 */
class ImapMessageInfoTest extends ZimbraStructTestCase
{
    public function testImapMessageInfo()
    {
        $id = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $type = $this->faker->word;
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;

        $info = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $this->assertSame($type, $info->getType());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($tags, $info->getTags());

        $info = new ImapMessageInfo($id, $imapUid, '', 0, '');
        $info->setType($type)
           ->setFlags($flags)
           ->setTags($tags);
        $this->assertSame($type, $info->getType());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($tags, $info->getTags());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<m id="' . $id . '" i4uid="' . $imapUid . '" t="' . $type . '" f="' . $flags . '" tn="' . $tags . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, ImapMessageInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'i4uid' => $imapUid,
            't' => $type,
            'f' => $flags,
            'tn' => $tags,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, ImapMessageInfo::class, 'json'));
    }
}
