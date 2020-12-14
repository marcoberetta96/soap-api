<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlList, XmlRoot};

/**
 * ServerQueues struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="server")
 */
class ServerQueues
{
    /**
     * MTA server
     * @Accessor(getter="getServerName", setter="setServerName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $serverName;

    /**
     * Queue information
     * @Accessor(getter="getQueues", setter="setQueues")
     * @SerializedName("queue")
     * @Type("array<Zimbra\Admin\Struct\MailQueueCount>")
     * @XmlList(inline = true, entry = "queue")
     */
    private $queues;

    /**
     * Constructor method for ServerQueues
     * 
     * @param  string $serverName
     * @param  array  $queues
     * @return self
     */
    public function __construct($serverName, array $queues = [])
    {
        $this->setServerName($serverName)
             ->setQueues($queues);
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getServerName(): string
    {
        return $this->serverName;
    }

    /**
     * Sets ID
     *
     * @param  string $serverName
     * @return self
     */
    public function setServerName(string $serverName): self
    {
        $this->serverName = $serverName;
        return $this;
    }

    /**
     * Add queue
     *
     * @param  MailQueueCount $queue
     * @return self
     */
    public function addQueue(MailQueueCount $queue): self
    {
        $this->queues[] = $queue;
        return $this;
    }

    /**
     * Sets queues
     *
     * @param array $queues
     * @return self
     */
    public function setQueues(array $queues): self
    {
        $this->queues = [];
        foreach ($queues as $queue) {
            if ($queue instanceof MailQueueCount) {
                $this->queues[] = $queue;
            }
        }
        return $this;
    }

    /**
     * Gets queues
     *
     * @return array
     */
    public function getQueues(): array
    {
        return $this->queues;
    }
}
