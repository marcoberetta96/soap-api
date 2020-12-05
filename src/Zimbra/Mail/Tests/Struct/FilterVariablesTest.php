<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FilterVariable;
use Zimbra\Mail\Struct\FilterVariables;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FilterVariables.
 */
class FilterVariablesTest extends ZimbraStructTestCase
{
    public function testFilterVariables()
    {
        $index = mt_rand(1, 99);
        $name = $this->faker->word;
        $value = $this->faker->word;

        $variable = new FilterVariable($name, $value);
        $action = new FilterVariables($index, [$variable]);
        $this->assertSame([$variable], $action->getVariables());
        $action = new FilterVariables($index);
        $action->setVariables([$variable])
           ->addVariable($variable);
        $this->assertSame([$variable, $variable], $action->getVariables());
        $action->setVariables([$variable]);

        $xml = <<<EOT
<?xml version="1.0"?>
<filterVariables index="$index">
    <filterVariable name="$name" value="$value" />
</filterVariables>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FilterVariables::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'filterVariable' => [
                [
                    'name' => $name,
                    'value' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, FilterVariables::class, 'json'));
    }
}
