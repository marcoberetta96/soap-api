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
 * GetAllAlwaysOnClustersBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllAlwaysOnClustersBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("GetAllAlwaysOnClustersRequest")
     * @Type("Zimbra\Admin\Message\GetAllAlwaysOnClustersRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAllAlwaysOnClustersRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'GetAllAlwaysOnClustersRequest')]
    #[Type(name: GetAllAlwaysOnClustersRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("GetAllAlwaysOnClustersResponse")
     * @Type("Zimbra\Admin\Message\GetAllAlwaysOnClustersResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var GetAllAlwaysOnClustersResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'GetAllAlwaysOnClustersResponse')]
    #[Type(name: GetAllAlwaysOnClustersResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param GetAllAlwaysOnClustersRequest $request
     * @param GetAllAlwaysOnClustersResponse $response
     * @return self
     */
    public function __construct(
        ?GetAllAlwaysOnClustersRequest $request = NULL, ?GetAllAlwaysOnClustersResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof GetAllAlwaysOnClustersRequest) {
            $this->request = $request;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequest(): ?SoapRequestInterface
    {
        return $this->request;
    }

    /**
     * {@inheritdoc}
     */
    public function setResponse(SoapResponseInterface $response): self
    {
        if ($response instanceof GetAllAlwaysOnClustersResponse) {
            $this->response = $response;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse(): ?SoapResponseInterface
    {
        return $this->response;
    }
}
