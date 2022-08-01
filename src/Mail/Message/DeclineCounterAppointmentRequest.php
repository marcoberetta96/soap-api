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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\Msg;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * DeclineCounterAppointmentRequest class
 * Decline a change proposal from an attendee.  Sent by organizer to an attendee who has
 * previously sent a COUNTER message.  The syntax of the request is very similar to CreateAppointmentRequest.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeclineCounterAppointmentRequest extends SoapRequest
{
    /**
     * Details of the Decline Counter.
     * Should have an <inv> which encodes an iCalendar DECLINECOUNTER object
     * @Accessor(getter="getMsg", setter="setMsg")
     * @SerializedName("m")
     * @Type("Zimbra\Mail\Struct\Msg")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?Msg $msg = NULL;

    /**
     * Constructor method for DeclineCounterAppointmentRequest
     *
     * @param  Msg $msg
     * @return self
     */
    public function __construct(?Msg $msg = NULL)
    {
        if ($msg instanceof Msg) {
            $this->setMsg($msg);
        }
    }

    /**
     * Set msg
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * Get msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new DeclineCounterAppointmentEnvelope(
            new DeclineCounterAppointmentBody($this)
        );
    }
}
