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
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * GetAllActiveServersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllActiveServersResponse")
 */
class GetAllActiveServersResponse implements ResponseInterface
{
    /**
     * Information about active servers
     * 
     * @Accessor(getter="getServerList", setter="setServerList")
     * @SerializedName("server")
     * @Type("array<Zimbra\Admin\Struct\ServerInfo>")
     * @XmlList(inline = true, entry = "server")
     */
    private $serverList;

    /**
     * Constructor method for GetAllActiveServersResponse
     * @param array $serverList
     * @return self
     */
    public function __construct(array $serverList = [])
    {
        $this->setServerList($serverList);
    }

    /**
     * Add a server information
     *
     * @param  ServerInfo $server
     * @return self
     */
    public function addServer(ServerInfo $server): self
    {
        $this->serverList[] = $server;
        return $this;
    }

    /**
     * Sets server informations
     *
     * @param  array $serverList
     * @return self
     */
    public function setServerList(array $serverList): self
    {
        $this->serverList = [];
        foreach ($serverList as $server) {
            if ($server instanceof ServerInfo) {
                $this->serverList[] = $server;
            }
        }
        return $this;
    }

    /**
     * Gets server informations
     *
     * @return array
     */
    public function getServerList(): array
    {
        return $this->serverList;
    }
}
