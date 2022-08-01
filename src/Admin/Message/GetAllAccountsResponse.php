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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\AccountInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAllAccountsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAccountsResponse implements SoapResponseInterface
{
    /**
     * Information on accounts
     * 
     * @Accessor(getter="getAccountList", setter="setAccountList")
     * @Type("array<Zimbra\Admin\Struct\AccountInfo>")
     * @XmlList(inline=true, entry="account", namespace="urn:zimbraAdmin")
     */
    private $accounts = [];

    /**
     * Constructor method for GetAllAccountsResponse
     *
     * @param array $accounts
     * @return self
     */
    public function __construct(array $accounts = [])
    {
        $this->setAccountList($accounts);
    }

    /**
     * Add an account
     *
     * @param  AccountInfo $account
     * @return self
     */
    public function addAccount(AccountInfo $account): self
    {
        $this->accounts[] = $account;
        return $this;
    }

    /**
     * Set accounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setAccountList(array $accounts): self
    {
        $this->accounts = array_filter($accounts, static fn ($account) => $account instanceof AccountInfo);
        return $this;
    }

    /**
     * Get accounts
     *
     * @return array
     */
    public function getAccountList(): array
    {
        return $this->accounts;
    }
}
