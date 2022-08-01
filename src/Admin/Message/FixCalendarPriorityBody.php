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
 * FixCalendarPriorityBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FixCalendarPriorityBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("FixCalendarPriorityRequest")
     * @Type("Zimbra\Admin\Message\FixCalendarPriorityRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("FixCalendarPriorityResponse")
     * @Type("Zimbra\Admin\Message\FixCalendarPriorityResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor method for FixCalendarPriorityBody
     *
     * @return self
     */
    public function __construct(
        ?FixCalendarPriorityRequest $request = NULL, ?FixCalendarPriorityResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof FixCalendarPriorityRequest) {
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
        if ($response instanceof FixCalendarPriorityResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
