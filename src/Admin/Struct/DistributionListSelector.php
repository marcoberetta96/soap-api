<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\DistributionListBy;

/**
 * DistributionListSelector struct class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListSelector
{
    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\DistributionListBy")
     * @XmlAttribute
     */
    private DistributionListBy $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for DistributionListSelector
     * @param  DistributionListBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?DistributionListBy $by = NULL, ?string $value = NULL)
    {
        $this->setBy($by ?? DistributionListBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by selector
     *
     * @return DistributionListBy
     */
    public function getBy(): DistributionListBy
    {
        return $this->by;
    }

    /**
     * Set by selector
     *
     * @param  DistributionListBy $by
     * @return self
     */
    public function setBy(DistributionListBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $name
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
