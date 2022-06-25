<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};

/**
 * UnexpectedBlobInfo class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailboxBlobConsistency
{
    /**
     * Mailbox ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("int")
     * @XmlAttribute
     */
    private $id;

    /**
     * Information about missing blobs
     * @Accessor(getter="getMissingBlobs", setter="setMissingBlobs")
     * @SerializedName("missingBlobs")
     * @Type("array<Zimbra\Admin\Struct\MissingBlobInfo>")
     * @XmlList(inline=false, entry="item")
     */
    private $missingBlobs = [];

    /**
     * Information about items with incorrect sizes
     * @Accessor(getter="getIncorrectSizes", setter="setIncorrectSizes")
     * @SerializedName("incorrectSizes")
     * @Type("array<Zimbra\Admin\Struct\IncorrectBlobSizeInfo>")
     * @XmlList(inline=false, entry="item")
     */
    private $incorrectSizes = [];

    /**
     * Information about unexpected blobs
     * @Accessor(getter="getUnexpectedBlobs", setter="setUnexpectedBlobs")
     * @SerializedName("unexpectedBlobs")
     * @Type("array<Zimbra\Admin\Struct\UnexpectedBlobInfo>")
     * @XmlList(inline=false, entry="blob")
     */
    private $unexpectedBlobs = [];

    /**
     * Information about items with incorrect revisions
     * @Accessor(getter="getIncorrectRevisions", setter="setIncorrectRevisions")
     * @SerializedName("incorrectRevisions")
     * @Type("array<Zimbra\Admin\Struct\IncorrectBlobRevisionInfo>")
     * @XmlList(inline=false, entry="item")
     */
    private $incorrectRevisions = [];

    /**
     * Information about used blobs
     * @Accessor(getter="getUsedBlobs", setter="setUsedBlobs")
     * @SerializedName("usedBlobs")
     * @Type("array<Zimbra\Admin\Struct\UsedBlobInfo>")
     * @XmlList(inline=false, entry="item")
     */
    private $usedBlobs = [];

    /**
     * Constructor method for MailboxBlobConsistency
     * @param  int $id
     * @param  array  $missingBlobs
     * @param  array  $incorrectSizes
     * @param  array  $unexpectedBlobs
     * @param  array  $incorrectRevisions
     * @param  array  $usedBlobs
     * @return self
     */
    public function __construct(
        int $id,
        array $missingBlobs = [],
        array $incorrectSizes = [],
        array $unexpectedBlobs = [],
        array $incorrectRevisions = [],
        array $usedBlobs = []
    )
    {
        $this->setId($id)
             ->setMissingBlobs($missingBlobs)
             ->setIncorrectSizes($incorrectSizes)
             ->setUnexpectedBlobs($unexpectedBlobs)
             ->setIncorrectRevisions($incorrectRevisions)
             ->setUsedBlobs($usedBlobs);
    }

    /**
     * Gets mailbox ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets mailbox ID
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
     * Add missing blob
     *
     * @param  MissingBlobInfo $missingBlob
     * @return self
     */
    public function addMissingBlob(MissingBlobInfo $missingBlob): self
    {
        $this->missingBlobs[] = $missingBlob;
        return $this;
    }

    /**
     * Sets missing blobs
     *
     * @param  array $blobs
     * @return self
     */
    public function setMissingBlobs(array $blobs): self
    {
        $this->missingBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof MissingBlobInfo);
        return $this;
    }

    /**
     * Gets missing blobs
     *
     * @return array
     */
    public function getMissingBlobs(): array
    {
        return $this->missingBlobs;
    }

    /**
     * Add incorrect size item
     *
     * @param  IncorrectBlobSizeInfo $incorrectSize
     * @return self
     */
    public function addIncorrectSize(IncorrectBlobSizeInfo $incorrectSize): self
    {
        $this->incorrectSizes[] = $incorrectSize;
        return $this;
    }

    /**
     * Sets incorrect sizes
     *
     * @param  array $sizes
     * @return self
     */
    public function setIncorrectSizes(array $sizes): self
    {
        $this->incorrectSizes = array_filter($sizes, static fn ($size) => $size instanceof IncorrectBlobSizeInfo);
        return $this;
    }

    /**
     * Gets incorrect sizes
     *
     * @return array
     */
    public function getIncorrectSizes(): array
    {
        return $this->incorrectSizes;
    }

    /**
     * Add unexpected blob
     *
     * @param  UnexpectedBlobInfo $unexpectedBlob
     * @return self
     */
    public function addUnexpectedBlob(UnexpectedBlobInfo $unexpectedBlob): self
    {
        $this->unexpectedBlobs[] = $unexpectedBlob;
        return $this;
    }

    /**
     * Sets unexpected blobs
     *
     * @param  array $blobs
     * @return self
     */
    public function setUnexpectedBlobs(array $blobs): self
    {
        $this->unexpectedBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof UnexpectedBlobInfo);
        return $this;
    }

    /**
     * Gets unexpected blobs
     *
     * @return array
     */
    public function getUnexpectedBlobs(): array
    {
        return $this->unexpectedBlobs;
    }

    /**
     * Add incorrect revision
     *
     * @param  IncorrectBlobRevisionInfo $item
     * @return self
     */
    public function addIncorrectRevision(IncorrectBlobRevisionInfo $incorrectRevision): self
    {
        $this->incorrectRevisions[] = $incorrectRevision;
        return $this;
    }

    /**
     * Sets incorrect revisions
     *
     * @param  IncorrectRevisionsWrapper $revisions
     * @return self
     */
    public function setIncorrectRevisions(array $revisions): self
    {
        $this->incorrectRevisions = array_filter($revisions, static fn ($revision) => $revision instanceof IncorrectBlobRevisionInfo);
        return $this;
    }

    /**
     * Gets incorrect revisions
     *
     * @return array
     */
    public function getIncorrectRevisions(): array
    {
        return $this->incorrectRevisions;
    }

    /**
     * Add used blob
     *
     * @param  UsedBlobInfo $usedBlob
     * @return self
     */
    public function addUsedBlob(UsedBlobInfo $usedBlob): self
    {
        $this->usedBlobs[] = $usedBlob;
        return $this;
    }

    /**
     * Sets used blobs
     *
     * @param  UsedBlobsWrapper $blobs
     * @return self
     */
    public function setUsedBlobs(array $blobs): self
    {
        $this->usedBlobs = array_filter($blobs, static fn ($blob) => $blob instanceof UsedBlobInfo);
        return $this;
    }

    /**
     * Gets used blobs
     *
     * @return array
     */
    public function getUsedBlobs(): array
    {
        return $this->usedBlobs;
    }
}
