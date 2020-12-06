<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

use JMS\Serializer\{Context, GraphNavigator};
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface as SerializationVisitor;
use JMS\Serializer\Visitor\DeserializationVisitorInterface as DeserializationVisitor;

use Zimbra\Common\{SimpleXML, Text};
use Zimbra\Soap\Request\Batch;
use Zimbra\Admin\Struct\EntrySearchFilterMultiCond as MultiCond;
use Zimbra\Admin\Struct\EntrySearchFilterSingleCond as SingleCond;

/**
 * SerializerHandler class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
final class SerializerHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Soap\Request\Batch',
                'method' => 'jsonSerializeBatchRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'xml',
                'type' => 'Zimbra\Soap\Request\Batch',
                'method' => 'xmlSerializeBatchRequest',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'xml',
                'type' => 'Zimbra\Admin\Struct\EntrySearchFilterMultiCond',
                'method' => 'xmlDeserializeSearchFilterMultiCond',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Zimbra\Admin\Struct\EntrySearchFilterMultiCond',
                'method' => 'jsonDeserializeSearchFilterMultiCond',
            ],
        ];
    }

    public function jsonSerializeBatchRequest(
        SerializationVisitor $visitor, Batch $batchRequest, array $type, Context $context
    )
    {
        $data = [
            '_jsns' => 'urn:zimbra',
        ];
        $metadataFactory = $context->getMetadataFactory();

        $serializer = SerializerFactory::create();
        $onerror = $batchRequest->getOnError();
        if (!empty($onerror)) {
            $data['onerror'] = $onerror;
        }
        $requests = $batchRequest->getRequests();
        foreach ($requests as $key => $request) {
            $obj = json_decode($serializer->serialize($request, 'json'));
            $obj->requestId = (string) $key;
            $metadata = $metadataFactory->getMetadataForClass(get_class($request));
            $obj->_jsns = $metadata->xmlRootNamespace;
            $data[$metadata->xmlRootName] = $obj;
        }
        return $data;
    }

    public function xmlSerializeBatchRequest(
        SerializationVisitor $visitor, Batch $batchRequest, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $document = $visitor->getDocument();
        $batchXml = new SimpleXML('<BatchRequest xmlns="urn:zimbra" />');
        $onerror = $batchRequest->getOnError();
        if (!empty($onerror)) {
            $batchXml->addAttribute('onerror', $onerror);
        }
        $requests = $batchRequest->getRequests();
        foreach ($requests as $key => $request) {
            $requestXml = new SimpleXML($serializer->serialize($request, 'xml'));
            $requestXml->addAttribute('requestId', (string) $key);
            $batchXml->append($requestXml);
        }
        $document->loadXML($batchXml->asXml());
    }

    public function xmlDeserializeSearchFilterMultiCond(
        DeserializationVisitor $visitor, \SimpleXMLElement $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $conds = new MultiCond;
        $attributes = $data->attributes();
        foreach ($attributes as $key => $value) {
            if ($key == 'not') {
                $conds->setNot(Text::stringToBoolean($value));
            }
            if ($key == 'or') {
                $conds->setOr(Text::stringToBoolean($value));
            }
        }

        $children = $data->children();
        foreach ($children as $value) {
            $name = $value->getName();
            if ($name == 'conds') {
                $conds->addCondition(
                    $this->xmlDeserializeSearchFilterMultiCond($visitor, $value, $type, $context)
                );
            }
            if ($name == 'cond') {
                $conds->addCondition(
                    $serializer->deserialize($value->asXml(), SingleCond::class, 'xml')
                );
            }
        }
        return $conds;
    }

    public function jsonDeserializeSearchFilterMultiCond(
        DeserializationVisitor $visitor, $data, array $type, Context $context
    )
    {
        $serializer = SerializerFactory::create();
        $conds = new MultiCond;
        if (isset($data['not']) && $data['not'] !== NULL) {
            $conds->setNot($data['not']);
        }
        if (isset($data['or']) && $data['or'] !== NULL) {
            $conds->setOr($data['or']);
        }
        if (isset($data['conds']) && is_array($data['conds'])) {
            foreach ($data['conds'] as $value) {
                $conds->addCondition(
                    $this->jsonDeserializeSearchFilterMultiCond($visitor, $value, $type, $context)
                );
            }
        }
        if (isset($data['cond'])) {
            foreach ($data['cond'] as $value) {
                $conds->addCondition(
                    $serializer->deserialize(json_encode($value), SingleCond::class, 'json')
                );
            }
        }
        return $conds;
    }
}
