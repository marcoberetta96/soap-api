<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllAdminAccountsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllAdminAccountsResponse")
 */
class GetAllAdminAccountsResponse implements ResponseInterface
{
    /**
     * Information on accounts
     * 
     * @Accessor(getter="getAccountList", setter="setAccountList")
     * @SerializedName("account")
     * @Type("array<Zimbra\Admin\Struct\AccountInfo>")
     * @XmlList(inline = true, entry = "account")
     */
    private $accountList;

    /**
     * Constructor method for GetAllAdminAccountsResponse
     *
     * @param array $accountList
     * @return self
     */
    public function __construct(array $accountList = [])
    {
        $this->setAccountList($accountList);
    }

    /**
     * Add an account information
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function addAccount(AccountInfo $account): self
    {
        $this->accountList[] = $account;
        return $this;
    }

    /**
     * Sets account informations
     *
     * @param  array $accountList
     * @return self
     */
    public function setAccountList(array $accountList): self
    {
        $this->accountList = [];
        foreach ($accountList as $account) {
            if ($account instanceof AccountInfo) {
                $this->accountList[] = $account;
            }
        }
        return $this;
    }

    /**
     * Gets account informations
     *
     * @return array
     */
    public function getAccountList(): array
    {
        return $this->accountList;
    }
}
