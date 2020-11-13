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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * CreateXMPPComponentResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="CreateXMPPComponentResponse")
 */
class CreateXMPPComponentResponse implements ResponseInterface
{
    /**
     * Information about the newly created XMPP component
     * @Accessor(getter="getComponent", setter="setComponent")
     * @SerializedName("xmppcomponent")
     * @Type("Zimbra\Admin\Struct\XMPPComponentInfo")
     * @XmlElement()
     */
    private $component;

    /**
     * Constructor method for CreateXMPPComponentResponse
     * @param XMPPComponentInfo $component
     * @return self
     */
    public function __construct(XMPPComponentInfo $component)
    {
        $this->setComponent($component);
    }

    /**
     * Gets the component.
     *
     * @return XMPPComponentInfo
     */
    public function getComponent()
    {
        return $this->component;
    }

    /**
     * Sets the component.
     *
     * @param  XMPPComponentInfo $component
     * @return self
     */
    public function setComponent(XMPPComponentInfo $component): self
    {
        $this->component = $component;
        return $this;
    }
}
