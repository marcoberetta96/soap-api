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
use Zimbra\Mail\Struct\TagActionInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * TagActionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class TagActionResponse implements ResponseInterface
{
    /**
     * The <action> element contains information about the tags affected by
     * the operation if and only if the operation was successful
     * 
     * @Accessor(getter="getAction", setter="setAction")
     * @SerializedName("action")
     * @Type("Zimbra\Mail\Struct\TagActionInfo")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?TagActionInfo $action = NULL;

    /**
     * Constructor method for TagActionResponse
     *
     * @param  TagActionInfo $action
     * @return self
     */
    public function __construct(?TagActionInfo $action = NULL)
    {
        if ($action instanceof TagActionInfo) {
            $this->setAction($action);
        }
    }

    /**
     * Gets action
     *
     * @return TagActionInfo
     */
    public function getAction(): ?TagActionInfo
    {
        return $this->action;
    }

    /**
     * Sets action
     *
     * @param  TagActionInfo $action
     * @return self
     */
    public function setAction(TagActionInfo $action): self
    {
        $this->action = $action;
        return $this;
    }
}
