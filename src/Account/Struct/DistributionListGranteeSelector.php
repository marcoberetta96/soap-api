<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Common\Enum\DistributionListGranteeBy as GranteeBy;

/**
 * DistributionListGranteeSelector struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListGranteeSelector
{
    /**
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Common\Enum\GranteeType")
     * @XmlAttribute
     */
    private GranteeType $type;

    /**
     * @Accessor(getter="getBy", setter="setBy")
     * @SerializedName("by")
     * @Type("Zimbra\Common\Enum\DistributionListGranteeBy")
     * @XmlAttribute
     */
    private GranteeBy $by;

    /**
     * @Accessor(getter="getValue", setter="setValue")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * Constructor method for DistributionListGranteeSelector
     * 
     * @param GranteeType $type
     * @param GranteeBy $by
     * @param string $value
     * @return self
     */
    public function __construct(
        ?GranteeType $type = NULL, ?GranteeBy $by = NULL, ?string $value = NULL
    )
    {
        $this->setType($type ?? GranteeType::ALL())
             ->setBy($by ?? GranteeBy::ID());
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get grantee type
     *
     * @return GranteeType
     */
    public function getType(): GranteeType
    {
        return $this->type;
    }

    /**
     * Set grantee type
     *
     * @param  GranteeType $type
     * @return self
     */
    public function setType(GranteeType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get grantee by
     *
     * @return GranteeBy
     */
    public function getBy(): GranteeBy
    {
        return $this->by;
    }

    /**
     * Set grantee by
     *
     * @param  GranteeBy $by
     * @return self
     */
    public function setBy(GranteeBy $by): self
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
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }
}
