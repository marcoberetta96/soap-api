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
use Zimbra\Mail\Struct\FolderSpec;
use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetEffectiveFolderPermsRequest class
 * Returns the effective permissions of the specified folder
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetEffectiveFolderPermsRequest extends Request
{
    /**
     * Folder specification
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\FolderSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private FolderSpec $folder;

    /**
     * Constructor method for GetEffectiveFolderPermsRequest
     *
     * @param  FolderSpec $folder
     * @return self
     */
    public function __construct(FolderSpec $folder)
    {
        $this->setFolder($folder);
    }

    /**
     * Gets folder
     *
     * @return FolderSpec
     */
    public function getFolder(): FolderSpec
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  FolderSpec $folder
     * @return self
     */
    public function setFolder(FolderSpec $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetEffectiveFolderPermsEnvelope(
            new GetEffectiveFolderPermsBody($this)
        );
    }
}
