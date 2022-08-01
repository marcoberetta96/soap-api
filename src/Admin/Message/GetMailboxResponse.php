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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Admin\Struct\MailboxWithMailboxId as Mailbox;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetMailboxResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetMailboxResponse implements SoapResponseInterface
{
    /**
     * Information about mailbox
     * @Accessor(getter="getMbox", setter="setMbox")
     * @SerializedName("mbox")
     * @Type("Zimbra\Admin\Struct\MailboxWithMailboxId")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?Mailbox $mbox = NULL;

    /**
     * Constructor method for GetMailboxResponse
     *
     * @param Mailbox $mbox
     * @return self
     */
    public function __construct(?Mailbox $mbox = NULL)
    {
        if ($mbox instanceof Mailbox) {
            $this->setMbox($mbox);
        }
    }

    /**
     * Get the mailbox
     *
     * @return Mailbox
     */
    public function getMbox(): ?Mailbox
    {
        return $this->mbox;
    }

    /**
     * Set mailbox
     *
     * @param  Mailbox $mbox
     * @return self
     */
    public function setMbox(Mailbox $mbox): self
    {
        $this->mbox = $mbox;
        return $this;
    }
}
