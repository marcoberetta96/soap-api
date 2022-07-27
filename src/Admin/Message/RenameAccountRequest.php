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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * RenameAccountRequest class
 * Rename Account
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class RenameAccountRequest extends SoapRequest
{
    /**
     * Zimbra ID
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * New account name
     * @Accessor(getter="getNewName", setter="setNewName")
     * @SerializedName("newName")
     * @Type("string")
     * @XmlAttribute
     */
    private $newName;

    /**
     * Constructor method for RenameAccountRequest
     * 
     * @param string $id
     * @param string $newName
     * @return self
     */
    public function __construct(string $id = '', string $newName = '')
    {
        $this->setId($id)
             ->setNewName($newName);
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
     * Gets newName
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Sets newName
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName): self
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new RenameAccountEnvelope(
            new RenameAccountBody($this)
        );
    }
}
