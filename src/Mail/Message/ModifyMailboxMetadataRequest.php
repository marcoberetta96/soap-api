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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyMailboxMetadataRequest class
 * Modify Mailbox Metadata
 * - Modify request must contain one or more key/value pairs
 * - Existing keys' values will be replaced by new values
 * - Empty or null value will remove a key
 * - New keys can be added
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyMailboxMetadataRequest extends SoapRequest
{
    /**
     * Metadata changes
     * 
     * @Accessor(getter="getMetadata", setter="setMetadata")
     * @SerializedName("meta")
     * @Type("Zimbra\Mail\Struct\MailCustomMetadata")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?MailCustomMetadata $metadata = NULL;

    /**
     * Constructor method for ModifyMailboxMetadataRequest
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function __construct(?MailCustomMetadata $metadata = NULL)
    {
        if ($metadata instanceof MailCustomMetadata) {
            $this->setMetadata($metadata);
        }
    }

    /**
     * Get metadata
     *
     * @return MailCustomMetadata
     */
    public function getMetadata(): ?MailCustomMetadata
    {
        return $this->metadata;
    }

    /**
     * Set metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function setMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyMailboxMetadataEnvelope(
            new ModifyMailboxMetadataBody($this)
        );
    }
}
