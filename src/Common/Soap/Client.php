<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\{
    RequestFactoryInterface, RequestInterface, ResponseInterface, StreamFactoryInterface
};

/**
 * Client is a class which provides a http client for SOAP services
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Client implements ClientInterface
{
    const REQUEST_METHOD  = 'POST';

    /**
     * Soap service url
     * 
     * @var string
     */
    private $serviceUrl;

    /**
     * Http cookie
     * 
     * @var string
     */
    private $cookie;

    /**
     * Http client
     * 
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * Request factory
     * 
     * @var RequestFactoryInterface
     */
    private RequestFactoryInterface $requestFactory;

    /**
     * Stream factory
     * 
     * @var StreamFactoryInterface
     */
    private StreamFactoryInterface $streamFactory;

    /**
     * Http request message
     * 
     * @var RequestInterface
     */
    private ?RequestInterface $httpRequest = NULL;

    /**
     * Http response message
     * 
     * @var ResponseInterface
     */
    private ?ResponseInterface $httpResponse = NULL;

    /**
     * Constructor
     *
     * @param string $serviceUrl
     * @param HttpClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(
        string $serviceUrl,
        HttpClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    )
    {
        $this->serviceUrl = $serviceUrl;
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function sendRequest(string $soapMessage, array $headers = []): ?ResponseInterface
    {
        $httpRequest = $this->requestFactory
            ->createRequest(self::REQUEST_METHOD, $this->serviceUrl)
            ->withBody($this->streamFactory->createStream($soapMessage));
        foreach ($headers as $name => $value) {
            $httpRequest = $httpRequest->withHeader($name, $value);
        }
        if (!empty($this->cookie)) {
            $httpRequest = $httpRequest->withHeader('Cookie', $this->cookie);
        }
        $this->httpRequest = $httpRequest;
        try {
            $this->httpResponse = $this->httpClient->sendRequest($this->httpRequest);
            if ($this->httpResponse->hasHeader('Set-Cookie')) {
                $this->cookie = implode(', ', $this->httpResponse->getHeader('Set-Cookie'));
            }
        }
        catch (ClientExceptionInterface $ex) {
            throw $ex;
        }
        return $this->httpResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpRequest(): ?RequestInterface
    {
        return $this->httpRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpResponse(): ?ResponseInterface
    {
        return $this->httpResponse;
    }
}
