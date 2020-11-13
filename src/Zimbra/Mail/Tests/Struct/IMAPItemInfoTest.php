<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\IMAPItemInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IMAPItemInfo.
 */
class IMAPItemInfoTest extends ZimbraStructTestCase
{
    public function testIMAPItemInfo()
    {
        $id = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);

        $info = new IMAPItemInfo($id, $imapUid);
        $this->assertSame($id, $info->getId());
        $this->assertSame($imapUid, $info->getImapUid());

        $info = new IMAPItemInfo(0, '');
        $info->setId($id)
           ->setImapUid($imapUid);
        $this->assertSame($id, $info->getId());
        $this->assertSame($imapUid, $info->getImapUid());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<m id="' . $id . '" i4uid="' . $imapUid . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, IMAPItemInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'i4uid' => $imapUid,
        ]);
        $this->assertSame($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, IMAPItemInfo::class, 'json'));
    }
}
