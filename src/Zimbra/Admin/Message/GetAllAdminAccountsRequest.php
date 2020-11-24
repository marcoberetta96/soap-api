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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * GetAllAdminAccountsRequest class
 * Get all Admin accounts
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAllAdminAccountsRequest")
 */
class GetAllAdminAccountsRequest extends Request
{
    /**
     * Apply COS [default 1 (true)]
     * @Accessor(getter="isApplyCos", setter="setApplyCos")
     * @SerializedName("applyCos")
     * @Type("bool")
     * @XmlAttribute
     */
    private $applyCos;

    /**
     * Constructor method for GetAllAdminAccountsRequest
     * @param  bool $applyCos
     * @return self
     */
    public function __construct($applyCos = NULL)
    {
        if (NULL !== $applyCos) {
            $this->setApplyCos($applyCos);
        }
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function isApplyCos(): bool
    {
        return $this->applyCos;
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos): self
    {
        $this->applyCos = (bool) $applyCos;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAllAdminAccountsEnvelope)) {
            $this->envelope = new GetAllAdminAccountsEnvelope(
                new GetAllAdminAccountsBody($this)
            );
        }
    }
}
