<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\{AlarmTriggerInfoInterface, DateAttrInterface, DurationInfoInterface};

/**
 * AlarmTriggerInfo struct class
 * Alarm trigger information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AlarmTriggerInfo implements AlarmTriggerInfoInterface
{
    /**
     * Absolute trigger information
     * @Accessor(getter="getAbsolute", setter="setAbsolute")
     * @SerializedName("abs")
     * @Type("Zimbra\Mail\Struct\DateAttr")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?DateAttrInterface $absolute = NULL;

    /**
     * Relative trigger information
     * @Accessor(getter="getRelative", setter="setRelative")
     * @SerializedName("rel")
     * @Type("Zimbra\Mail\Struct\DurationInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?DurationInfoInterface $relative = NULL;

    /**
     * Constructor method
     *
     * @param DateAttr $absolute
     * @param DurationInfo $relative
     * @return self
     */
    public function __construct(
        ?DateAttr $absolute = NULL,
        ?DurationInfo $relative = NULL
    )
    {
        if ($absolute instanceof DateAttr) {
            $this->setAbsolute($absolute);
        }
        if ($relative instanceof DurationInfo) {
            $this->setRelative($relative);
        }
    }

    /**
     * Get the absolute
     *
     * @return DateAttrInterface
     */
    public function getAbsolute(): ?DateAttrInterface
    {
        return $this->absolute;
    }

    /**
     * Set the absolute
     *
     * @param  DateAttrInterface $absolute
     * @return self
     */
    public function setAbsolute(DateAttrInterface $absolute): self
    {
        $this->absolute = $absolute;
        return $this;
    }

    /**
     * Get the relative
     *
     * @return DurationInfoInterface
     */
    public function getRelative(): ?DurationInfoInterface
    {
        return $this->relative;
    }

    /**
     * Set the relative
     *
     * @param  DurationInfoInterface $relative
     * @return self
     */
    public function setRelative(DurationInfoInterface $relative): self
    {
        $this->relative = $relative;
        return $this;
    }
}
