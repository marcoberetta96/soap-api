<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\IncorrectBlobRevisionInfo;
use Zimbra\Admin\Struct\BlobRevisionInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IncorrectBlobRevisionInfo.
 */
class IncorrectBlobRevisionInfoTest extends ZimbraTestCase
{
    public function testIncorrectBlobRevisionInfo()
    {
        $path = $this->faker->word;
        $size = mt_rand(1, 100);
        $fileSize = mt_rand(1, 100);
        $id = mt_rand(1, 100);
        $revision = mt_rand(1, 100);
        $volumeId = mt_rand(1, 100);

        $blob = new BlobRevisionInfo(
            $path, $fileSize, $revision, TRUE
        );

        $item = new StubIncorrectBlobRevisionInfo(
            $id, $revision, $size, $volumeId, $blob
        );
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $item = new StubIncorrectBlobRevisionInfo();
        $item->setId($id)
              ->setRevision($revision)
              ->setSize($size)
              ->setVolumeId($volumeId)
              ->setBlob($blob);
        $this->assertSame($id, $item->getId());
        $this->assertSame($revision, $item->getRevision());
        $this->assertSame($size, $item->getSize());
        $this->assertSame($volumeId, $item->getVolumeId());
        $this->assertEquals($blob, $item->getBlob());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" rev="$revision" s="$size" volumeId="$volumeId" xmlns:urn="urn:zimbraAdmin">
    <urn:blob path="$path" fileSize="$fileSize" rev="$revision" external="true" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, StubIncorrectBlobRevisionInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubIncorrectBlobRevisionInfo extends IncorrectBlobRevisionInfo
{
}
