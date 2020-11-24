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
use Zimbra\Admin\Struct\DistributionListInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllDistributionListsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllDistributionListsResponse")
 */
class GetAllDistributionListsResponse implements ResponseInterface
{
    /**
     * Information on distribution lists
     * 
     * @Accessor(getter="getDls", setter="setDls")
     * @SerializedName("dl")
     * @Type("array<Zimbra\Admin\Struct\DistributionListInfo>")
     * @XmlList(inline = true, entry = "dl")
     */
    private $dls;

    /**
     * Constructor method for GetAllDistributionListsResponse
     * @param array $dls
     * @return self
     */
    public function __construct(array $dls = [])
    {
        $this->setDls($dls);
    }

    /**
     * Add dl
     *
     * @param  DistributionListInfo $dl
     * @return self
     */
    public function addDl(DistributionListInfo $dl): self
    {
        $this->dls[] = $dl;
        return $this;
    }

    /**
     * Sets dls
     *
     * @param  array $dls
     * @return self
     */
    public function setDls(array $dls): self
    {
        $this->dls = [];
        foreach ($dls as $dl) {
            if ($dl instanceof DistributionListInfo) {
                $this->dls[] = $dl;
            }
        }
        return $this;
    }

    /**
     * Gets dls
     *
     * @return array
     */
    public function getDls(): array
    {
        return $this->dls;
    }
}
