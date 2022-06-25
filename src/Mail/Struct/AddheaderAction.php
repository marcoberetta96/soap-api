<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

/**
 * AddheaderAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class AddheaderAction extends FilterAction
{
    /**
     * new header name
     * @Accessor(getter="getHeaderName", setter="setHeaderName")
     * @SerializedName("headerName")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $headerName;

    /**
     * new header value
     * @Accessor(getter="getHeaderValue", setter="setHeaderValue")
     * @SerializedName("headerValue")
     * @Type("string")
     * @XmlElement(cdata=false)
     */
    private $headerValue;

    /**
     * Last header
     * @Accessor(getter="getLast", setter="setLast")
     * @SerializedName("last")
     * @Type("bool")
     * @XmlAttribute
     */
    private $last;

    /**
     * Constructor method for AddheaderAction
     * 
     * @param int $index
     * @param string $headerName
     * @param string $headerValue
     * @param bool $last
     * @return self
     */
    public function __construct(
        ?int $index = NULL, ?string $headerName = NULL, ?string $headerValue = NULL, ?bool $last = NULL
    )
    {
        parent::__construct($index);
        if (NULL !== $headerName) {
            $this->setHeaderName($headerName);
        }
        if (NULL !== $headerValue) {
            $this->setHeaderValue($headerValue);
        }
        if (NULL !== $last) {
            $this->setLast($last);
        }
    }

    /**
     * Gets headerName
     *
     * @return string
     */
    public function getHeaderName(): ?string
    {
        return $this->headerName;
    }

    /**
     * Sets headerName
     *
     * @param  string $headerName
     * @return self
     */
    public function setHeaderName(string $headerName)
    {
        $this->headerName = $headerName;
        return $this;
    }

    /**
     * Gets headerValue
     *
     * @return string
     */
    public function getHeaderValue(): ?string
    {
        return $this->headerValue;
    }

    /**
     * Sets headerValue
     *
     * @param  string $headerValue
     * @return self
     */
    public function setHeaderValue(string $headerValue)
    {
        $this->headerValue = $headerValue;
        return $this;
    }

    /**
     * Gets last
     *
     * @return bool
     */
    public function getLast(): ?bool
    {
        return $this->last;
    }

    /**
     * Sets last
     *
     * @param  bool $last
     * @return self
     */
    public function setLast(bool $last)
    {
        $this->last = $last;
        return $this;
    }
}
