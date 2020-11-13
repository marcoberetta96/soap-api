<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Account\Struct\CheckRightsTargetInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CheckRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CheckRightsResponse", namespace="urn:zimbraAccount")
 */
class CheckRightsResponse implements ResponseInterface
{
    /**
     * @Accessor(getter="getTargets", setter="setTargets")
     * @SerializedName("target")
     * @Type("array<Zimbra\Account\Struct\CheckRightsTargetInfo>")
     * @XmlList(inline = true, entry = "target")
     */
    private $targets;

    /**
     * Constructor method for CheckRightsResponse
     * @param  array $targets Rights information for targets
     * @return self
     */
    public function __construct(array $targets = [])
    {
        $this->setTargets($targets);
    }

    /**
     * Add a target
     *
     * @param  CheckRightsTargetInfo $target
     * @return self
     */
    public function addTarget(CheckRightsTargetInfo $target): self
    {
        $this->targets[] = $target;
        return $this;
    }

    /**
     * Set targets
     *
     * @param  array $requests
     * @return Sequence
     */
    public function setTargets(array $targets): self
    {
        $this->targets = [];
        foreach ($targets as $target) {
            if ($target instanceof CheckRightsTargetInfo) {
                $this->targets[] = $target;
            }
        }
        return $this;
    }

    /**
     * Gets targets
     *
     * @return array
     */
    public function getTargets(): array
    {
        return $this->targets;
    }
}
