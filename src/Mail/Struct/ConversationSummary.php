<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};

/**
 * ConversationSummary struct class
 * Conversation search result information
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ConversationSummary
{
    /**
     * Conversation ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Number of messages in conversation without IMAP \Deleted flag set
     * @Accessor(getter="getNum", setter="setNum")
     * @SerializedName("n")
     * @Type("integer")
     * @XmlAttribute
     */
    private $num;

    /**
     * Number of unread messages in conversation
     * @Accessor(getter="getNumUnread", setter="setNumUnread")
     * @SerializedName("u")
     * @Type("integer")
     * @XmlAttribute
     */
    private $numUnread;

    /**
     * Total number of messages in conversation including those with the IMAP \Deleted flag set
     * @Accessor(getter="getTotalSize", setter="setTotalSize")
     * @SerializedName("total")
     * @Type("integer")
     * @XmlAttribute
     */
    private $totalSize;

    /**
     * Same flags as on <m> ("sarwfdxnu!?"), aggregated from all the conversation's messages
     * @Accessor(getter="getFlags", setter="setFlags")
     * @SerializedName("f")
     * @Type("string")
     * @XmlAttribute
     */
    private $flags;

    /**
     * Tags - Comma separated list of integers.  DEPRECATED - use "tn" instead
     * @Accessor(getter="getTags", setter="setTags")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $tags;

    /**
     * Comma-separated list of tag names
     * @Accessor(getter="getTagNames", setter="setTagNames")
     * @SerializedName("tn")
     * @Type("string")
     * @XmlAttribute
     */
    private $tagNames;

    /**
     * Date (secs since epoch) of most recent message in the converstation
     * @Accessor(getter="getDate", setter="setDate")
     * @SerializedName("d")
     * @Type("integer")
     * @XmlAttribute
     */
    private $date;

    /**
     * If elided is set, some participants are missing before the first returned <e> element
     * @Accessor(getter="getElided", setter="setElided")
     * @SerializedName("elided")
     * @Type("bool")
     * @XmlAttribute
     */
    private $elided;

    /**
     * Modified date in seconds
     * @Accessor(getter="getChangeDate", setter="setChangeDate")
     * @SerializedName("md")
     * @Type("integer")
     * @XmlAttribute
     */
    private $changeDate;

    /**
     * Modified sequence
     * @Accessor(getter="getModifiedSequence", setter="setModifiedSequence")
     * @SerializedName("ms")
     * @Type("integer")
     * @XmlAttribute
     */
    private $modifiedSequence;

    /**
     * Custom metadata
     * @Accessor(getter="getMetadatas", setter="setMetadatas")
     * @SerializedName("meta")
     * @Type("array<Zimbra\Mail\Struct\MailCustomMetadata>")
     * @XmlList(inline=true, entry="meta")
     */
    private $metadatas = [];

    /**
     * Subject of conversation
     * @Accessor(getter="getSubject", setter="setSubject")
     * @SerializedName("su")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $subject;

    /**
     * First few bytes of the message (probably between 40 and 100 bytes)
     * @Accessor(getter="getFragment", setter="setFragment")
     * @SerializedName("fr")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $fragment;

    /**
     * Email addresses
     * @Accessor(getter="getEmails", setter="setEmails")
     * @SerializedName("e")
     * @Type("array<Zimbra\Mail\Struct\EmailInfo>")
     * @XmlList(inline=true, entry="e")
     */
    private $emails = [];

    /**
     * Constructor method
     *
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?int $num = NULL,
        ?int $numUnread = NULL,
        ?int $totalSize = NULL,
        ?string $flags = NULL,
        ?string $tags = NULL,
        ?string $tagNames = NULL,
        ?int $date = NULL,
        ?bool $elided = NULL,
        ?int $changeDate = NULL,
        ?int $modifiedSequence = NULL,
        array $metadatas = [],
        ?string $subject = NULL,
        ?string $fragment = NULL,
        array $emails = []
    )
    {
        $this->setMetadatas($metadatas)
             ->setEmails($emails);
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $num) {
            $this->setNum($num);
        }
        if (NULL !== $numUnread) {
            $this->setNumUnread($numUnread);
        }
        if (NULL !== $totalSize) {
            $this->setTotalSize($totalSize);
        }
        if (NULL !== $flags) {
            $this->setFlags($flags);
        }
        if (NULL !== $tags) {
            $this->setTags($tags);
        }
        if (NULL !== $tagNames) {
            $this->setTagNames($tagNames);
        }
        if (NULL !== $date) {
            $this->setDate($date);
        }
        if (NULL !== $elided) {
            $this->setElided($elided);
        }
        if (NULL !== $changeDate) {
            $this->setChangeDate($changeDate);
        }
        if (NULL !== $modifiedSequence) {
            $this->setModifiedSequence($modifiedSequence);
        }
        if (NULL !== $subject) {
            $this->setSubject($subject);
        }
        if (NULL !== $fragment) {
            $this->setFragment($fragment);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets num
     *
     * @return int
     */
    public function getNum(): ?int
    {
        return $this->num;
    }

    /**
     * Sets num
     *
     * @param  int $num
     * @return self
     */
    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    /**
     * Gets numUnread
     *
     * @return int
     */
    public function getNumUnread(): ?int
    {
        return $this->numUnread;
    }

    /**
     * Sets numUnread
     *
     * @param  int $numUnread
     * @return self
     */
    public function setNumUnread(int $numUnread): self
    {
        $this->numUnread = $numUnread;
        return $this;
    }

    /**
     * Gets totalSize
     *
     * @return int
     */
    public function getTotalSize(): ?int
    {
        return $this->totalSize;
    }

    /**
     * Sets totalSize
     *
     * @param  int $totalSize
     * @return self
     */
    public function setTotalSize(int $totalSize): self
    {
        $this->totalSize = $totalSize;
        return $this;
    }

    /**
     * Gets flags
     *
     * @return string
     */
    public function getFlags(): ?string
    {
        return $this->flags;
    }

    /**
     * Sets flags
     *
     * @param  string $flags
     * @return self
     */
    public function setFlags(string $flags): self
    {
        $this->flags = $flags;
        return $this;
    }

    /**
     * Gets tags
     *
     * @return string
     */
    public function getTags(): ?string
    {
        return $this->tags;
    }

    /**
     * Sets tags
     *
     * @param  string $tags
     * @return self
     */
    public function setTags(string $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Gets tagNames
     *
     * @return string
     */
    public function getTagNames(): ?string
    {
        return $this->tagNames;
    }

    /**
     * Sets tagNames
     *
     * @param  string $tagNames
     * @return self
     */
    public function setTagNames(string $tagNames): self
    {
        $this->tagNames = $tagNames;
        return $this;
    }

    /**
     * Gets date
     *
     * @return int
     */
    public function getDate(): ?int
    {
        return $this->date;
    }

    /**
     * Sets date
     *
     * @param  int $date
     * @return self
     */
    public function setDate(int $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Gets elided
     *
     * @return bool
     */
    public function getElided(): ?bool
    {
        return $this->elided;
    }

    /**
     * Sets elided
     *
     * @param  bool $elided
     * @return self
     */
    public function setElided(bool $elided): self
    {
        $this->elided = $elided;
        return $this;
    }

    /**
     * Gets changeDate
     *
     * @return int
     */
    public function getChangeDate(): ?int
    {
        return $this->changeDate;
    }

    /**
     * Sets changeDate
     *
     * @param  int $changeDate
     * @return self
     */
    public function setChangeDate(int $changeDate): self
    {
        $this->changeDate = $changeDate;
        return $this;
    }

    /**
     * Gets modifiedSequence
     *
     * @return int
     */
    public function getModifiedSequence(): ?int
    {
        return $this->modifiedSequence;
    }

    /**
     * Sets modifiedSequence
     *
     * @param  int $modifiedSequence
     * @return self
     */
    public function setModifiedSequence(int $modifiedSequence): self
    {
        $this->modifiedSequence = $modifiedSequence;
        return $this;
    }

    /**
     * Gets metadatas
     *
     * @return array
     */
    public function getMetadatas(): array
    {
        return $this->metadatas;
    }

    /**
     * Sets metadatas
     *
     * @param  array $metadatas
     * @return self
     */
    public function setMetadatas(array $metadatas): self
    {
        $this->metadatas = array_filter($metadatas, static fn($metadata) => $metadata instanceof MailCustomMetadata);
        return $this;
    }

    /**
     * Add metadata
     *
     * @param  MailCustomMetadata $metadata
     * @return self
     */
    public function addMetadata(MailCustomMetadata $metadata): self
    {
        $this->metadatas[] = $metadata;
        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Sets subject
     *
     * @param  string $subject
     * @return self
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Gets fragment
     *
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->fragment;
    }

    /**
     * Sets fragment
     *
     * @param  string $fragment
     * @return self
     */
    public function setFragment(string $fragment): self
    {
        $this->fragment = $fragment;
        return $this;
    }

    /**
     * Sets emails
     *
     * @param  array $emails
     * @return self
     */
    public function setEmails(array $emails): self
    {
        $this->emails = array_filter($emails, static fn($email) => $email instanceof EmailInfo);
        return $this;
    }

    /**
     * Gets emails
     *
     * @return array
     */
    public function getEmails(): array
    {
        return $this->emails;
    }

    /**
     * Add email
     *
     * @param  EmailInfo $email
     * @return self
     */
    public function addEmail(EmailInfo $email): self
    {
        $this->emails[] = $email;
        return $this;
    }

}
