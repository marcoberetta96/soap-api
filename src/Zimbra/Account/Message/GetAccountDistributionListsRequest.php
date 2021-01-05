<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Enum\MemberOfSelector;
use Zimbra\Soap\Request;

/**
 * GetAccountDistributionListsRequest class
 * Returns groups the user is either a member or an owner of. 
 * Notes:
 *  - isOwner is returned only if ownerOf on the request is 1 (true).
 *  - isMember is returned only if memberOf on the request is not "none".
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020 by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAccountDistributionListsRequest")
 */
class GetAccountDistributionListsRequest extends Request
{
    /**
     * Set to 1 if the response should include groups the user is an owner of.
     * Set to 0 (default) if do not need to know which groups the user is an owner of.
     * @Accessor(getter="getOwnerOf", setter="setOwnerOf")
     * @SerializedName("ownerOf")
     * @Type("bool")
     * @XmlAttribute
     */
    private $ownerOf;

    /**
     * Possible values: all|directOnly|none
     * @Accessor(getter="getMemberOf", setter="setMemberOf")
     * @SerializedName("memberOf")
     * @Type("Zimbra\Enum\MemberOfSelector")
     * @XmlAttribute
     */
    private $memberOf;

    /**
     * comma-seperated attributes to return.
     * Note: non-owner user can see only certain attributes of a group.
     * If a specified attribute is not visible to the user, it will not be returned.
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("string")
     * @XmlAttribute
     */
    private $attrs;

    /**
     * Constructor method for GetAccountDistributionLists
     *
     * @param  bool $ownerOf
     * @param  MemberOfSelector $memberOf
     * @param  string $attrs
     * @return self
     */
    public function __construct(
        ?bool $ownerOf = NULL,
        ?MemberOfSelector $memberOf = NULL,
        ?string $attrs = NULL
    )
    {
        if(NULL !== $ownerOf) {
            $this->setOwnerOf($ownerOf);
        }
        if($memberOf instanceof MemberOfSelector) {
            $this->setMemberOf($memberOf);
        }
        if(NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
    }

    /**
     * Gets ownerOf
     *
     * @return bool
     */
    public function getOwnerOf(): ?bool
    {
        return $this->ownerOf;
    }

    /**
     * Sets ownerOf
     *
     * @param  bool $ownerOf
     * @return self
     */
    public function setOwnerOf(bool $ownerOf): self
    {
        $this->ownerOf = $ownerOf;
        return $this;
    }

    /**
     * Gets attrs
     *
     * @return string
     */
    public function getAttrs(): ?string
    {
        return $this->attrs;
    }

    /**
     * Sets attrs
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs(string $attrs): self
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * Gets memberOf
     *
     * @return MemberOfSelector
     */
    public function getMemberOf(): ?MemberOfSelector
    {
        return $this->memberOf;
    }

    /**
     * Sets memberOf
     *
     * @param  MemberOfSelector $memberOf
     * @return self
     */
    public function setMemberOf(MemberOfSelector $memberOf): self
    {
        $this->memberOf = $memberOf;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAccountDistributionListsEnvelope)) {
            $this->envelope = new GetAccountDistributionListsEnvelope(
                new GetAccountDistributionListsBody($this)
            );
        }
    }
}
