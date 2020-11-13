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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};
use Zimbra\Enum\{TargetBy, TargetType};

/**
 * CheckRightsTargetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="target")
 */
class CheckRightsTargetSpec
{
    /**
     * @Accessor(getter="getTargetType", setter="setTargetType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\TargetType")
     * @XmlAttribute
     */
    private $targetType;

    /**
     * @Accessor(getter="getTargetBy", setter="setTargetBy")
     * @SerializedName("by")
     * @Type("Zimbra\Enum\TargetBy")
     * @XmlAttribute
     */
    private $targetBy;

    /**
     * @Accessor(getter="getTargetKey", setter="setTargetKey")
     * @SerializedName("key")
     * @Type("string")
     * @XmlAttribute
     */
    private $targetKey;

    /**
     * @Accessor(getter="getRights", setter="setRights")
     * @SerializedName("right")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "right")
     */
    private $rights;

    /**
     * Constructor method for CheckRightsTargetSpec
     * @param  TargetType $type
     * @param  TargetBy $by
     * @param  string $key
     * @param  array $rights
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by, $key, array $rights = [])
    {
        $this->setTargetType($type)
            ->setTargetBy($by)
            ->setTargetKey($key)
            ->setRights($rights);
    }

    /**
     * Gets target type
     *
     * @return TargetType
     */
    public function getTargetType(): TargetType
    {
        return $this->targetType;
    }

    /**
     * Sets target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setTargetType(TargetType $type): self
    {
        $this->targetType = $type;
        return $this;
    }

    /**
     * Gets target by
     *
     * @return TargetBy
     */
    public function getTargetBy(): TargetBy
    {
        return $this->targetBy;
    }

    /**
     * Sets target by
     *
     * @param  TargetBy $by
     * @return self
     */
    public function setTargetBy(TargetBy $by): self
    {
        $this->targetBy = $by;
        return $this;
    }

    /**
     * Gets target key
     *
     * @return string
     */
    public function getTargetKey(): string
    {
        return $this->targetKey;
    }

    /**
     * Sets target key
     *
     * @param  string $key
     * @return self
     */
    public function setTargetKey($key = null): self
    {
        $this->targetKey = trim($key);
        return $this;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right): self
    {
        $right = trim($right);
        if (!empty($right)) {
            $this->rights[] = $right;
        }
        return $this;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = [];
        foreach ($rights as $right) {
            $this->addRight($right);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
