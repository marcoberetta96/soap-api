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
 * GetCreateObjectAttrsBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetCreateObjectAttrsBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetCreateObjectAttrsRequest")
     * @Type("Zimbra\Admin\Message\GetCreateObjectAttrsRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapRequestInterface $request = NULL;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetCreateObjectAttrsResponse")
     * @Type("Zimbra\Admin\Message\GetCreateObjectAttrsResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?SoapResponseInterface $response = NULL;

    /**
     * Constructor method for GetCreateObjectAttrsBody
     *
     * @return self
     */
    public function __construct(?GetCreateObjectAttrsRequest $request = NULL, ?GetCreateObjectAttrsResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetCreateObjectAttrsRequest) {
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
        if ($response instanceof GetCreateObjectAttrsResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
