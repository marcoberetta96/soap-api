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
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetAllRightsResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllRightsResponse implements SoapResponseInterface
{
    /**
     * Information for rights
     * 
     * @Accessor(getter="getRights", setter="setRights")
     * @Type("array<Zimbra\Admin\Struct\RightInfo>")
     * @XmlList(inline=true, entry="right", namespace="urn:zimbraAdmin")
     */
    private $rights = [];

    /**
     * Constructor method for GetAllRightsResponse
     *
     * @param array $rights
     * @return self
     */
    public function __construct(array $rights = [])
    {
        $this->setRights($rights);
    }

    /**
     * Add a right information
     *
     * @param  RightInfo $right
     * @return self
     */
    public function addRight(RightInfo $right): self
    {
        $this->rights[] = $right;
        return $this;
    }

    /**
     * Sets right informations
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter($rights, static fn ($right) => $right instanceof RightInfo);
        return $this;
    }

    /**
     * Gets right informations
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
