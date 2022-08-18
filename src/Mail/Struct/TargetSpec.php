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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\{AccountBy, TargetType};

/**
 * TargetSpec class
 * Target specification
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TargetSpec
{
    /**
     * Target type
     * 
     * @var TargetType
     */
    #[Accessor(getter: 'getTargetType', setter: 'setTargetType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\TargetType>')]
    #[XmlAttribute]
    private $targetType;

    /**
     * Select the meaning of {value}
     * 
     * @var AccountBy
     */
    #[Accessor(getter: 'getAccountBy', setter: 'setAccountBy')]
    #[SerializedName(name: 'by')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\AccountBy>')]
    #[XmlAttribute]
    private $accountBy;

    /**
     * The key used to identify the target
     * Meaning determined by {accountBy}
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     *
     * @param  TargetType $targetType
     * @param  AccountBy $accountBy
     * @param  string $value
     * @return self
     */
    public function __construct(
        ?TargetType $targetType = NULL, ?AccountBy $accountBy = NULL, ?string $value = NULL
    )
    {
        $this->setTargetType($targetType ?? TargetType::ACCOUNT)
             ->setAccountBy($accountBy ?? AccountBy::NAME);
        if (NULL !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get targetType
     *
     * @return TargetType
     */
    public function getTargetType(): TargetType
    {
        return $this->targetType;
    }

    /**
     * Set targetType
     *
     * @param  TargetType $targetType
     * @return self
     */
    public function setTargetType(TargetType $targetType): self
    {
        $this->targetType = $targetType;
        return $this;
    }

    /**
     * Get accountBy
     *
     * @return AccountBy
     */
    public function getAccountBy(): AccountBy
    {
        return $this->accountBy;
    }

    /**
     * Set accountBy
     *
     * @param  AccountBy $accountBy
     * @return self
     */
    public function setAccountBy(AccountBy $accountBy): self
    {
        $this->accountBy = $accountBy;
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
