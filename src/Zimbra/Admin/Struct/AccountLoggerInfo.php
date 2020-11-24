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
 * AccountLoggerInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="accountLogger")
 */
class AccountLoggerInfo
{
    /**
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Logger information
     * @Accessor(getter="getLoggers", setter="setLoggers")
     * @SerializedName("logger")
     * @Type("array<Zimbra\Admin\Struct\LoggerInfo>")
     * @XmlList(inline = true, entry = "logger")
     */
    private $loggers;

    /**
     * Constructor method for AccountLoggerInfo
     * 
     * @param  string $name
     * @param  string $id
     * @param  array  $loggers
     * @return self
     */
    public function __construct($name, $id, array $loggers = [])
    {
        $this->setName($name)
             ->setId($id)
             ->setLoggers($loggers);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name): self
    {
        $this->name = trim($name);
        return $this;
    }

    /**
     * Gets ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Add logger
     *
     * @param  LoggerInfo $logger
     * @return self
     */
    public function addLogger(LoggerInfo $logger): self
    {
        $this->loggers[] = $logger;
        return $this;
    }

    /**
     * Sets loggers
     *
     * @param array $loggers
     * @return self
     */
    public function setLoggers(array $loggers): self
    {
        $this->loggers = [];
        foreach ($loggers as $logger) {
            if ($logger instanceof LoggerInfo) {
                $this->loggers[] = $logger;
            }
        }
        return $this;
    }

    /**
     * Gets loggers
     *
     * @return array
     */
    public function getLoggers(): array
    {
        return $this->loggers;
    }
}
