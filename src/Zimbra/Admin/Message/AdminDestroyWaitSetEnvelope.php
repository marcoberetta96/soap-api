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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\{BodyInterface, Envelope, Header};

/**
 * AdminDestroyWaitSetEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class AdminDestroyWaitSetEnvelope extends Envelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Admin\Message\AdminDestroyWaitSetBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private $body;

    /**
     * Constructor method for AdminDestroyWaitSetEnvelope
     * @return self
     */
    public function __construct(Header $header = NULL, AdminDestroyWaitSetBody $body = NULL)
    {
        parent::__construct($header, $body);
    }

    /**
     * Gets soap message body
     *
     * @return BodyInterface
     */
    public function getBody(): BodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  BodyInterface $body
     * @return self
     */
    public function setBody(BodyInterface $body): Envelope
    {
        if ($body instanceof AdminDestroyWaitSetBody) {
            $this->body = $body;
        }
        return $this;
    }
}
