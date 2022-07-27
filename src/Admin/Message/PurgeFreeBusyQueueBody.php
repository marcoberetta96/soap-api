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
use Zimbra\Common\Struct\{SoapBody, SoapRequestInterface, SoapResponseInterface};

/**
 * PurgeFreeBusyQueueBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class PurgeFreeBusyQueueBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("PurgeFreeBusyQueueRequest")
     * @Type("Zimbra\Admin\Message\PurgeFreeBusyQueueRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("PurgeFreeBusyQueueResponse")
     * @Type("Zimbra\Admin\Message\PurgeFreeBusyQueueResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor method for PurgeFreeBusyQueueBody
     *
     * @return self
     */
    public function __construct(?PurgeFreeBusyQueueRequest $request = NULL, ?PurgeFreeBusyQueueResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof PurgeFreeBusyQueueRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof PurgeFreeBusyQueueResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
