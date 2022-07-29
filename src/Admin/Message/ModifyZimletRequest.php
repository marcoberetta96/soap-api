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
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * ModifyZimletRequest class
 * Modify Zimlet
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ModifyZimletRequest extends SoapRequest
{
    /**
     * New Zimlet information
     * @Accessor(getter="getZimlet", setter="setZimlet")
     * @SerializedName("zimlet")
     * @Type("Zimbra\Admin\Struct\ZimletAclStatusPri")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ZimletAclStatusPri $zimlet;

    /**
     * Constructor method for ModifyZimletRequest
     * 
     * @param ZimletAclStatusPri $zimlet
     * @return self
     */
    public function __construct(ZimletAclStatusPri $zimlet)
    {
        $this->setZimlet($zimlet);
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get the data source.
     *
     * @return ZimletAclStatusPri
     */
    public function getZimlet(): ZimletAclStatusPri
    {
        return $this->zimlet;
    }

    /**
     * Set the data source
     *
     * @param  ZimletAclStatusPri $zimlet
     * @return self
     */
    public function setZimlet(ZimletAclStatusPri $zimlet): self
    {
        $this->zimlet = $zimlet;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ModifyZimletEnvelope(
            new ModifyZimletBody($this)
        );
    }
}
