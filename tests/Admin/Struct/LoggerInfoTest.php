<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\LoggerInfo;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LoggerInfo.
 */
class LoggerInfoTest extends ZimbraTestCase
{
    public function testLoggerInfo()
    {
        $category = $this->faker->word;

        $logger = new LoggerInfo($category, LoggingLevel::ERROR());
        $this->assertSame($category, $logger->getCategory());
        $this->assertEquals(LoggingLevel::ERROR(), $logger->getLevel());

        $logger = new LoggerInfo('');
        $logger->setCategory($category)
               ->setLevel(LoggingLevel::INFO());
        $this->assertSame($category, $logger->getCategory());
        $this->assertEquals(LoggingLevel::INFO(), $logger->getLevel());

        $level = LoggingLevel::INFO()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<logger category="$category" level="$level" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($logger, 'xml'));
        $this->assertEquals($logger, $this->serializer->deserialize($xml, LoggerInfo::class, 'xml'));

        $json = json_encode([
            'category' => $category,
            'level' => $level,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($logger, 'json'));
        $this->assertEquals($logger, $this->serializer->deserialize($json, LoggerInfo::class, 'json'));
    }
}
