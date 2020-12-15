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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\ServerSelector as Server;
use Zimbra\Enum\IpType;
use Zimbra\Soap\Request;

/**
 * GetServerNIfsRequest request class
 * Get Network Interface information for a server
 * Get server's network interfaces. Returns IP  addresses and net masks
 * This call will use zmrcd to call /opt/zimbra/libexec/zmserverips
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetServerNIfsRequest")
 */
class GetServerNIfsRequest extends Request
{
    /**
     * specifics the ipAddress type (ipV4/ipV6/both). default is ipv4
     * @Accessor(getter="getType", setter="setType")
     * @SerializedName("type")
     * @Type("Zimbra\Enum\IpType")
     * @XmlAttribute
     */
    private $type;

    /**
     * Server
     * @Accessor(getter="getServer", setter="setServer")
     * @SerializedName("server")
     * @Type("Zimbra\Admin\Struct\ServerSelector")
     * @XmlElement
     */
    private $server;

    /**
     * Constructor method for GetServerNIfsRequest
     * 
     * @param  Server $server
     * @param  IpType $type
     * @return self
     */
    public function __construct(Server $server, IpType $type = NULL)
    {
        $this->setServer($server);
        if ($type instanceof IpType) {
            $this->setType($type);
        }
    }

    /**
     * Gets type
     *
     * @return IpType
     */
    public function getType(): ?IpType
    {
        return $this->type;
    }

    /**
     * Sets type
     *
     * @param  IpType $type
     * @return self
     */
    public function setType(IpType $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets the server.
     *
     * @return Server
     */
    public function getServer(): ?Server
    {
        return $this->server;
    }

    /**
     * Sets the server.
     *
     * @param  Server $server
     * @return self
     */
    public function setServer(Server $server): self
    {
        $this->server = $server;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetServerNIfsEnvelope)) {
            $this->envelope = new GetServerNIfsEnvelope(
                new GetServerNIfsBody($this)
            );
        }
    }
}
