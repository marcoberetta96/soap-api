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
use Zimbra\Admin\Struct\AlwaysOnClusterInfo;
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * CreateAlwaysOnClusterResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CreateAlwaysOnClusterResponse implements SoapResponseInterface
{
    /**
     * Information about the newly created cluster
     * @Accessor(getter="getAlwaysOnCluster", setter="setAlwaysOnCluster")
     * @SerializedName("alwaysOnCluster")
     * @Type("Zimbra\Admin\Struct\AlwaysOnClusterInfo")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?AlwaysOnClusterInfo $cluster = NULL;

    /**
     * Constructor method for CreateAlwaysOnClusterResponse
     *
     * @param AlwaysOnClusterInfo $cluster
     * @return self
     */
    public function __construct(?AlwaysOnClusterInfo $cluster = NULL)
    {
        if ($cluster instanceof AlwaysOnClusterInfo) {
            $this->setAlwaysOnCluster($cluster);
        }
    }

    /**
     * Get the alwaysOnCluster.
     *
     * @return AlwaysOnClusterInfo
     */
    public function getAlwaysOnCluster(): ?AlwaysOnClusterInfo
    {
        return $this->alwaysOnCluster;
    }

    /**
     * Set the alwaysOnCluster.
     *
     * @param  AlwaysOnClusterInfo $alwaysOnCluster
     * @return self
     */
    public function setAlwaysOnCluster(AlwaysOnClusterInfo $alwaysOnCluster): self
    {
        $this->alwaysOnCluster = $alwaysOnCluster;
        return $this;
    }
}
