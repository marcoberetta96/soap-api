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

/**
 * AuthToken struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AuthToken
{
    /**
     * Value for authorization token
     * @Accessor(getter="getValue", setter="setValue")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $value;

    /**
     * If verifyAccount="1", account is required and the account in the auth token is compared to the named account.
     * If verifyAccount="0" (default), only the auth token is verified and any account element specified is ignored.
     * @Accessor(getter="getVerifyAccount", setter="setVerifyAccount")
     * @SerializedName("verifyAccount")
     * @Type("bool")
     * @XmlAttribute
     */
    private $verifyAccount;

    /**
     * Life time of the auth token
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlAttribute
     */
    private $lifetime;

    /**
     * Constructor method for AuthToken
     * @param  string $value
     * @param  bool   $verifyAccount
     * @param  int   $lifetime
     * @return self
     */
    public function __construct(string $value, ?bool $verifyAccount = NULL, ?int $lifetime = NULL)
    {
        $this->setValue($value);
        if (NULL !== $verifyAccount) {
            $this->setVerifyAccount($verifyAccount);
        }
        if (NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Gets auth token is verified flag
     *
     * @return bool
     */
    public function getVerifyAccount(): ?bool
    {
        return $this->verifyAccount;
    }

    /**
     * Sets auth token is verified flag
     *
     * @param  bool $verifyAccount
     * @return self
     */
    public function setVerifyAccount(bool $verifyAccount)
    {
        $this->verifyAccount = $verifyAccount;
        return $this;
    }

    /**
     * Gets life time of the auth token
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Sets life time of the auth token
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime)
    {
        $this->lifetime = $lifetime;
        return $this;
    }
}
