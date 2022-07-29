<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponseInterface;

/**
 * GetYahooCookieResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetYahooCookieResponse implements SoapResponseInterface
{
    /**
     * Error
     * 
     * @Accessor(getter="getError", setter="setError")
     * @SerializedName("error")
     * @Type("string")
     * @XmlAttribute
     */
    private $error;

    /**
     * Crumb
     * 
     * @Accessor(getter="getCrumb", setter="setCrumb")
     * @SerializedName("crumb")
     * @Type("string")
     * @XmlAttribute
     */
    private $crumb;

    /**
     * Y
     * 
     * @Accessor(getter="getY", setter="setY")
     * @SerializedName("y")
     * @Type("string")
     * @XmlAttribute
     */
    private $y;

    /**
     * T
     * 
     * @Accessor(getter="getT", setter="setT")
     * @SerializedName("t")
     * @Type("string")
     * @XmlAttribute
     */
    private $t;

    /**
     * Constructor method for GetYahooCookieRequest
     *
     * @param  string $error
     * @param  string $crumb
     * @param  string $y
     * @param  string $t
     * @return self
     */
    public function __construct(
        ?string $error = NULL, ?string $crumb = NULL, ?string $y = NULL, ?string $t = NULL
    )
    {
        if (NULL !== $error) {
            $this->setError($error);
        }
        if (NULL !== $crumb) {
            $this->setCrumb($crumb);
        }
        if (NULL !== $y) {
            $this->setY($y);
        }
        if (NULL !== $t) {
            $this->setT($t);
        }
    }

    /**
     * Get crumb
     *
     * @return string
     */
    public function getCrumb(): ?string
    {
        return $this->crumb;
    }

    /**
     * Set crumb
     *
     * @param  string $crumb
     * @return self
     */
    public function setCrumb(string $crumb): self
    {
        $this->crumb = $crumb;
        return $this;
    }

    /**
     * Get error
     *
     * @return string
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Set error
     *
     * @param  string $error
     * @return self
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }

    /**
     * Get y
     *
     * @return string
     */
    public function getY(): ?string
    {
        return $this->y;
    }

    /**
     * Set y
     *
     * @param  string $y
     * @return self
     */
    public function setY(string $y): self
    {
        $this->y = $y;
        return $this;
    }

    /**
     * Get t
     *
     * @return string
     */
    public function getT(): ?string
    {
        return $this->t;
    }

    /**
     * Set t
     *
     * @param  string $t
     * @return self
     */
    public function setT(string $t): self
    {
        $this->t = $t;
        return $this;
    }
}
