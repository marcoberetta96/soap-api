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
use Zimbra\Admin\Struct\{AdminAttrs, AdminAttrsImplTrait};
use Zimbra\Soap\Request;

/**
 * ModifyAccountRequest class
 * Modify an account
 * Notes:
 * an empty attribute value removes the specified attr
 * this request is by default proxied to the account's home server
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ModifyAccountRequest")
 */
class ModifyAccountRequest extends Request implements AdminAttrs
{
    use AdminAttrsImplTrait;

    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Constructor method for ModifyAccountRequest
     * 
     * @param string $id
     * @param array  $attrs
     * @return self
     */
    public function __construct(string $id, array $attrs = [])
    {
        $this->setId($id)
             ->setAttrs($attrs);
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): string
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
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof ModifyAccountEnvelope)) {
            $this->envelope = new ModifyAccountEnvelope(
                new ModifyAccountBody($this)
            );
        }
    }
}
