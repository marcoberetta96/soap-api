<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\AccountBy;

/**
 * AccountNameSelector class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AccountNameSelector
{
    /**
     * @var AccountBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName(name: 'by')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\AccountBy>')]
    #[XmlAttribute]
    private $by;

    /**
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  AccountBy $by
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?AccountBy $by = NULL, ?string $name = NULL, ?string $value = NULL
    )
    {
        $this->setBy($by ?? AccountBy::NAME);
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get account by
     *
     * @return AccountBy
     */
    public function getBy(): AccountBy
    {
        return $this->by;
    }

    /**
     * Set account by enum
     *
     * @param  AccountBy $by
     * @return self
     */
    public function setBy(AccountBy $by): self
    {
        $this->by = $by;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
