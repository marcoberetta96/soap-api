<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Common\Struct\{SoapBodyInterface, SoapEnvelope, SoapHeaderInterface};

/**
 * ForwardAppointmentEnvelope class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
#[XmlRoot(name: 'soap:Envelope')]
class ForwardAppointmentEnvelope extends SoapEnvelope
{
    /**
     * @var ForwardAppointmentBody
     */
    #[Accessor(getter: 'getBody', setter: 'setBody')]
    #[SerializedName('Body')]
    #[Type(ForwardAppointmentBody::class)]
    #[XmlElement(namespace: 'http://www.w3.org/2003/05/soap-envelope')]
    private $body;

    /**
     * Constructor
     *
     * @param  ForwardAppointmentBody $body
     * @param  SoapHeaderInterface $header
     * @return self
     */
    public function __construct(?ForwardAppointmentBody $body = NULL, ?SoapHeaderInterface $header = NULL)
    {
        parent::__construct($body, $header);
    }

    /**
     * {@inheritdoc}
     */
    public function getBody(): ?SoapBodyInterface
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function setBody(SoapBodyInterface $body): self
    {
        if ($body instanceof ForwardAppointmentBody) {
            $this->body = $body;
        }
        return $this;
    }
}
