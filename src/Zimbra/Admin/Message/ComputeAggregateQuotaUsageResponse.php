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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\DomainAggregateQuotaInfo as QuotaInfo;
use Zimbra\Soap\ResponseInterface;

/**
 * ComputeAggregateQuotaUsageResponse class
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="ComputeAggregateQuotaUsageResponse")
 */
class ComputeAggregateQuotaUsageResponse implements ResponseInterface
{
    /**
     * Aggregate quota information for domain
     * 
     * @Accessor(getter="getDomainQuotas", setter="setDomainQuotas")
     * @SerializedName("domain")
     * @Type("array<Zimbra\Admin\Struct\DomainAggregateQuotaInfo>")
     * @XmlList(inline = true, entry = "domain")
     */
    private $domainQuotas;

    /**
     * Constructor method for ComputeAggregateQuotaUsageResponse
     *
     * @param array $domainQuotas
     * @return self
     */
    public function __construct(array $domainQuotas = [])
    {
        $this->setDomainQuotas($domainQuotas);
    }

    /**
     * Add a domain quota
     *
     * @param  QuotaInfo $domainQuota
     * @return self
     */
    public function addDomainQuota(QuotaInfo $domainQuota): self
    {
        $this->domainQuotas[] = $domainQuota;
        return $this;
    }

    /**
     * Sets domain quotas
     *
     * @param  array $domainQuotas
     * @return self
     */
    public function setDomainQuotas(array $domainQuotas): self
    {
        $this->domainQuotas = [];
        foreach ($domainQuotas as $domainQuota) {
            if ($domainQuota instanceof QuotaInfo) {
                $this->domainQuotas[] = $domainQuota;
            }
        }
        return $this;
    }

    /**
     * Gets domain quotas
     *
     * @return array
     */
    public function getDomainQuotas(): array
    {
        return $this->domainQuotas;
    }
}
