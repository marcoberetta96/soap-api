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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * IMAPItemInfo struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="m")
 */
class IMAPItemInfo
{
    /**
     * Message ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $id;

    /**
     * IMAP UID
     * @Accessor(getter="getImapUid", setter="setImapUid")
     * @SerializedName("i4uid")
     * @Type("int")
     * @XmlAttribute
     */
    private $imapUid;

    /**
     * Constructor method for IMAPItemInfo
     * @param  int $id Message ID
     * @param  int $imapUid IMAP UID
     * @return self
     */
    public function __construct(int $id, int $imapUid)
    {
        $this->setId($id)
             ->setImapUid($imapUid);
    }

    /**
     * Gets Message ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets Message ID
     *
     * @param  int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets IMAP UID
     *
     * @return int
     */
    public function getImapUid(): int
    {
        return $this->imapUid;
    }

    /**
     * Sets IMAP UID
     *
     * @param  int $imapUid
     * @return self
     */
    public function setImapUid(int$imapUid): self
    {
        $this->imapUid = $imapUid;
        return $this;
    }
}
