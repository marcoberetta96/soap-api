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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\FreeBusyProviderInfo;
use Zimbra\Common\Soap\ResponseInterface;

/**
 * GetAllFreeBusyProvidersResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllFreeBusyProvidersResponse implements ResponseInterface
{
    /**
     * Information on Free/Busy providers
     * 
     * @Accessor(getter="getProviders", setter="setProviders")
     * @Type("array<Zimbra\Admin\Struct\FreeBusyProviderInfo>")
     * @XmlList(inline=true, entry="provider", namespace="urn:zimbraAdmin")
     */
    private $providers = [];

    /**
     * Constructor method for GetAllFreeBusyProvidersResponse
     *
     * @param array $providers
     * @return self
     */
    public function __construct(array $providers = [])
    {
        $this->setProviders($providers);
    }

    /**
     * Add a provider
     *
     * @param  FreeBusyProviderInfo $provider
     * @return self
     */
    public function addProvider(FreeBusyProviderInfo $provider): self
    {
        $this->providers[] = $provider;
        return $this;
    }

    /**
     * Sets providers
     *
     * @param  array $providers
     * @return self
     */
    public function setProviders(array $providers): self
    {
        $this->providers = array_filter($providers, static fn ($provider) => $provider instanceof FreeBusyProviderInfo);
        return $this;
    }

    /**
     * Gets providers
     *
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}
