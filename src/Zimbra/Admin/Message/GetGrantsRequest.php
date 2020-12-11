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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlRoot};
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector as Target;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Soap\Request;

/**
 * GetGrantsRequest request class
 * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
 * The authenticated admin must have an effective "viewGrants" (TBD) system right on the specified target/grantee.
 * At least one of <target> or <grantee> must be specified.
 * If both <target> and <grantee> are specified, only grants that are granted on the target to the grantee are returned.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetGrantsRequest")
 */
class GetGrantsRequest extends Request
{
    /**
     * Target
     * @Accessor(getter="getTarget", setter="setTarget")
     * @SerializedName("target")
     * @Type("Zimbra\Admin\Struct\EffectiveRightsTargetSelector")
     * @XmlElement
     */
    private $target;

    /**
     * Grantee
     * @Accessor(getter="getGrantee", setter="setGrantee")
     * @SerializedName("grantee")
     * @Type("Zimbra\Admin\Struct\GranteeSelector")
     * @XmlElement
     */
    private $grantee;

    /**
     * Constructor method for GetGrantsRequest
     * 
     * @param  Target $target
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function __construct(
        ?Target $target = NULL,
        ?GranteeSelector $grantee = NULL
    )
    {
        if ($target instanceof Target) {
            $this->setTarget($target);
        }
        if ($grantee instanceof GranteeSelector) {
            $this->setGrantee($grantee);
        }
    }

    /**
     * Gets target.
     *
     * @return Target
     */
    public function getTarget(): ?Target
    {
        return $this->target;
    }

    /**
     * Sets target.
     *
     * @param  Target $target
     * @return self
     */
    public function setTarget(Target $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Gets grantee.
     *
     * @return GranteeSelector
     */
    public function getGrantee(): ?GranteeSelector
    {
        return $this->grantee;
    }

    /**
     * Sets grantee.
     *
     * @param  GranteeSelector $grantee
     * @return self
     */
    public function setGrantee(GranteeSelector $grantee): self
    {
        $this->grantee = $grantee;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetGrantsEnvelope)) {
            $this->envelope = new GetGrantsEnvelope(
                new GetGrantsBody($this)
            );
        }
    }
}
