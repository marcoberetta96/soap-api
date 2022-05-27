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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Common\Struct\ShareInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetShareInfoResponse class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetShareInfoResponse implements ResponseInterface
{
    /**
     * Shares
     * @Accessor(getter="getShares", setter="setShares")
     * @SerializedName("share")
     * @Type("array<Zimbra\Common\Struct\ShareInfo>")
     * @XmlList(inline = true, entry = "share")
     */
    private $shares = [];

    /**
     * Constructor method for GetShareInfoResponse
     * 
     * @param  array $shares
     * @return self
     */
    public function __construct(array $shares = [])
    {
        $this->setShares($shares);
    }

    /**
     * Add a share
     *
     * @param  ShareInfo $share
     * @return self
     */
    public function addShare(ShareInfo $share): self
    {
        $this->shares[] = $share;
        return $this;
    }

    /**
     * Set shares
     *
     * @param  array $shares
     * @return self
     */
    public function setShares(array $shares): self
    {
        $this->shares = [];
        foreach ($shares as $share) {
            if ($share instanceof ShareInfo) {
                $this->shares[] = $share;
            }
        }
        return $this;
    }

    /**
     * Gets shares
     *
     * @return array
     */
    public function getShares(): array
    {
        return $this->shares;
    }
}
