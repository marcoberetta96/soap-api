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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * DistributionListMembershipInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DistributionListMembershipInfo
{
    /**
     * Distribution list ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Distribution list name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Present if the dl is a member of the returned list because they are either a direct
     * or indirect member of another list that is a member of the returned list.
     * @Accessor(getter="getVia", setter="setVia")
     * @SerializedName("via")
     * @Type("string")
     * @XmlAttribute
     */
    private $via;

    /**
     * Constructor method for DistributionListMembershipInfo
     *
     * @param string $id
     * @param string $name
     * @param string $via
     * @return self
     */
    public function __construct(string $id, string $name, ?string $via = NULL)
    {
        $this->setId($id)
             ->setName($name);
        if (NULL !== $via) {
            $this->setVia($via);
        }
    }

    /**
     * Gets the id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets the id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets via
     *
     * @return string
     */
    public function getVia(): ?string
    {
        return $this->via;
    }

    /**
     * Sets via
     *
     * @param  string $via
     * @return self
     */
    public function setVia(string $via): self
    {
        $this->via = $via;
        return $this;
    }
}
