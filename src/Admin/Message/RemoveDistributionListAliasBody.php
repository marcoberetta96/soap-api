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
 * RemoveDistributionListAliasBody class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RemoveDistributionListAliasBody extends SoapBody
{
    /**
     * @Accessor(getter="getRequest", setter="setRequest")
     * @SerializedName("RemoveDistributionListAliasRequest")
     * @Type("Zimbra\Admin\Message\RemoveDistributionListAliasRequest")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var RemoveDistributionListAliasRequest
     */
    #[Accessor(getter: 'getRequest', setter: 'setRequest')]
    #[SerializedName(name: 'RemoveDistributionListAliasRequest')]
    #[Type(name: RemoveDistributionListAliasRequest::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $request;

    /**
     * @Accessor(getter="getResponse", setter="setResponse")
     * @SerializedName("RemoveDistributionListAliasResponse")
     * @Type("Zimbra\Admin\Message\RemoveDistributionListAliasResponse")
     * @XmlElement(namespace="urn:zimbraAdmin")
     * 
     * @var RemoveDistributionListAliasResponse
     */
    #[Accessor(getter: 'getResponse', setter: 'setResponse')]
    #[SerializedName(name: 'RemoveDistributionListAliasResponse')]
    #[Type(name: RemoveDistributionListAliasResponse::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $response;

    /**
     * Constructor
     *
     * @param RemoveDistributionListAliasRequest $request
     * @param RemoveDistributionListAliasResponse $response
     * @return self
     */
    public function __construct(
        ?RemoveDistributionListAliasRequest $request = NULL, ?RemoveDistributionListAliasResponse $response = NULL
    )
    {
        parent::__construct($request, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function setRequest(SoapRequestInterface $request): self
    {
        if ($request instanceof RemoveDistributionListAliasRequest) {
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
        if ($response instanceof RemoveDistributionListAliasResponse) {
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
