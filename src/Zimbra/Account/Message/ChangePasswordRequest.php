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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Soap\Request;
use Zimbra\Struct\AccountSelector;

/**
 * ChangePasswordRequest class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ChangePasswordRequest", namespace="urn:zimbraAccount")
 */
class ChangePasswordRequest extends Request
{
    /**
     * @Accessor(getter="getAccount", setter="setAccount")
     * @SerializedName("account")
     * @Type("Zimbra\Struct\AccountSelector")
     * @XmlElement
     */
    private $account;

    /**
     * @Accessor(getter="getOldPassword", setter="setOldPassword")
     * @SerializedName("oldPassword")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $oldPassword;

    /**
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $password;

    /**
     * @Accessor(getter="getVirtualHost", setter="setVirtualHost")
     * @SerializedName("virtualHost")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $virtualHost;

    /**
     * Constructor method for ChangePasswordRequest
     * @param  AccountSelector   $account Details of the account
     * @param  string    $oldPassword Old password
     * @param  string    $newPassword New Password to assign
     * @param  string    $virtualHost specified virtual-host is used to determine the domain of the account name
     * @return self
     */
    public function __construct(
        AccountSelector $account,
        $oldPassword,
        $newPassword,
        $virtualHost = NULL
    )
    {
        $this->setAccount($account)
            ->setOldPassword($oldPassword)
            ->setPassword($newPassword);
        if(NULL !== $virtualHost) {
            $this->setVirtualHost($virtualHost);
        }
    }

    /**
     * Gets the account to authenticate against
     *
     * @return AccountSelector
     */
    public function getAccount(): AccountSelector
    {
        return $this->account;
    }

    /**
     * Sets the account to authenticate against
     *
     * @param  AccountSelector $account
     * @return self
     */
    public function setAccount(AccountSelector $account): self
    {
        $this->account = $account;
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password): self
    {
        $this->password = trim($password);
        return $this;
    }

    /**
     * Gets old password
     *
     * @return string
     */
    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    /**
     * Sets old password
     *
     * @param  string $password
     * @return self
     */
    public function setOldPassword($password): self
    {
        $this->oldPassword = trim($password);
        return $this;
    }

    /**
     * Gets virtual host
     *
     * @return string
     */
    public function getVirtualHost(): string
    {
        return $this->virtualHost;
    }

    /**
     * Sets virtual host
     *
     * @param  string $virtualHost
     * @return self
     */
    public function setVirtualHost($virtualHost): self
    {
        $this->virtualHost = trim($virtualHost);
        return $this;
    }

    protected function internalInit()
    {
        $this->envelope = new ChangePasswordEnvelope(
            NULL,
            new ChangePasswordBody($this)
        );
    }
}
