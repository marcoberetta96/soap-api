<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\FailedTestInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FailedTestInfo.
 */
class FailedTestInfoTest extends ZimbraTestCase
{
    public function testFailedTestInfo()
    {
        $name = $this->faker->word;
        $execSeconds = time();
        $className = $this->faker->word;
        $throwable = $this->faker->word;

        $failure = new FailedTestInfo($name, $execSeconds, $className, $throwable);
        $this->assertSame($name, $failure->getName());
        $this->assertSame($execSeconds, $failure->getExecSeconds());
        $this->assertSame($className, $failure->getClassName());
        $this->assertSame($throwable, $failure->getThrowable());

        $failure = new FailedTestInfo('', 0, '', '');
        $failure->setName($name)
            ->setExecSeconds($execSeconds)
            ->setClassName($className)
            ->setThrowable($throwable);
        $this->assertSame($name, $failure->getName());
        $this->assertSame($execSeconds, $failure->getExecSeconds());
        $this->assertSame($className, $failure->getClassName());
        $this->assertSame($throwable, $failure->getThrowable());

        $xml = <<<EOT
<?xml version="1.0"?>
<failure name="$name" execSeconds="$execSeconds" class="$className">$throwable</failure>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($failure, 'xml'));
        $this->assertEquals($failure, $this->serializer->deserialize($xml, FailedTestInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'execSeconds' => $execSeconds,
            'class' => $className,
            '_content' => $throwable,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($failure, 'json'));
        $this->assertEquals($failure, $this->serializer->deserialize($json, FailedTestInfo::class, 'json'));
    }
}
