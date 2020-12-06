<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FilterAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FilterAction.
 */
class FilterActionTest extends ZimbraStructTestCase
{
    public function testFilterAction()
    {
        $index = mt_rand(1, 99);

        $action = new FilterAction($index);
        $this->assertSame($index, $action->getIndex());

        $action = new FilterAction();
        $action->setIndex($index);
        $this->assertSame($index, $action->getIndex());

        $xml = <<<EOT
<?xml version="1.0"?>
<action index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FilterAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, FilterAction::class, 'json'));
    }
}
