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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlList};
use Zimbra\Admin\Struct\FreeBusyQueueProvider;
use Zimbra\Soap\ResponseInterface;

/**
 * GetFreeBusyQueueInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetFreeBusyQueueInfoResponse implements ResponseInterface
{
    /**
     * Information on Free/Busy providers
     * 
     * @Accessor(getter="getProviders", setter="setProviders")
     * @SerializedName("provider")
     * @Type("array<Zimbra\Admin\Struct\FreeBusyQueueProvider>")
     * @XmlList(inline = true, entry = "provider")
     */
    private $providers = [];

    /**
     * Constructor method for GetFreeBusyQueueInfoResponse
     *
     * @param  array $providers
     * @return self
     */
    public function __construct(array $providers = [])
    {
        $this->setProviders($providers);
    }

    /**
     * Add a provider
     *
     * @param  FreeBusyQueueProvider $provider
     * @return self
     */
    public function addProvider(FreeBusyQueueProvider $provider): self
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
        $this->providers = array_filter($providers, static fn ($provider) => $provider instanceof FreeBusyQueueProvider);
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
