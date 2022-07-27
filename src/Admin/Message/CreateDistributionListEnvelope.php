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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Common\Struct\{SoapBodyInterface, SoapEnvelope, SoapHeaderInterface};

/**
 * CreateDistributionListEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @XmlRoot(name="soap:Envelope")
 */
class CreateDistributionListEnvelope extends SoapEnvelope
{
    /**
     * @Accessor(getter="getBody", setter="setBody")
     * @SerializedName("Body")
     * @Type("Zimbra\Admin\Message\CreateDistributionListBody")
     * @XmlElement(namespace="http://www.w3.org/2003/05/soap-envelope")
     */
    private ?SoapBodyInterface $body = NULL;

    /**
     * Constructor method for CreateDistributionListEnvelope
     *
     * @return self
     */
    public function __construct(?CreateDistributionListBody $body = NULL, ?SoapHeaderInterface $header = NULL)
    {
        parent::__construct($body, $header);
    }

    /**
     * Gets soap message body
     *
     * @return SoapBodyInterface
     */
    public function getBody(): ?SoapBodyInterface
    {
        return $this->body;
    }

    /**
     * Sets soap message body
     *
     * @param  SoapBodyInterface $body
     * @return self
     */
    public function setBody(SoapBodyInterface $body): self
    {
        if ($body instanceof CreateDistributionListBody) {
            $this->body = $body;
        }
        return $this;
    }
}
