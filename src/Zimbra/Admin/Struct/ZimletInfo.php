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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlList, XmlRoot};

/**
 * ZimletInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="zimlet")
 */
class ZimletInfo extends AdminObjectInfo
{
    /**
     * @Accessor(getter="getHasKeyword", setter="setHasKeyword")
     * @SerializedName("hasKeyword")
     * @Type("string")
     * @XmlAttribute
     */
    private $hasKeyword;

    /**
     * Constructor method for ZimletInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $attrs
     * @param  string $hasKeyword
     * @return self
     */
    public function __construct($name, $id, array $attrs = [], $hasKeyword = NULL)
    {
        parent::__construct($name, $id, $attrs);
        if (NULL !== $hasKeyword) {
            $this->setHasKeyword($hasKeyword);
        }
    }

    /**
     * Gets Keyword
     *
     * @return string
     */
    public function getHasKeyword(): string
    {
        return $this->hasKeyword;
    }

    /**
     * Sets Keyword
     *
     * @param  string $hasKeyword
     * @return self
     */
    public function setHasKeyword($hasKeyword): self
    {
        $this->hasKeyword = trim($hasKeyword);
        return $this;
    }
}
