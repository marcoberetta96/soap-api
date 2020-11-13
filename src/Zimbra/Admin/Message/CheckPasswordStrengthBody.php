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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlElement, XmlNamespace, XmlRoot};
use Zimbra\Soap\{Body, RequestInterface, ResponseInterface};

/**
 * CheckPasswordStrengthBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 * @AccessType("public_method")
 * @XmlRoot(name="Body")
 */
class CheckPasswordStrengthBody extends Body
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("CheckPasswordStrengthRequest")
     * @Type("Zimbra\Admin\Message\CheckPasswordStrengthRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("CheckPasswordStrengthResponse")
     * @Type("Zimbra\Admin\Message\CheckPasswordStrengthResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private $response;

    /**
     * Constructor method for CheckPasswordStrengthBody
     * @return self
     */
    public function __construct(CheckPasswordStrengthRequest $request = NULL, CheckPasswordStrengthResponse $response = NULL)
    {
        parent::__construct($request, $response);
    }

    public function setRequest(RequestInterface $request): self
    {
        if ($request instanceof CheckPasswordStrengthRequest) {
            $this->request = $request;
        }
        return $this;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function setResponse(ResponseInterface $response): self
    {
        if ($response instanceof CheckPasswordStrengthResponse) {
            $this->response = $response;
        }
        return $this;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
