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
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * CheckExchangeAuthRequest request class
 * Check Exchange Authorisation
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class CheckExchangeAuthRequest extends SoapRequest
{
    /**
     * Exchange auth details
     * 
     * @Accessor(getter="getAuth", setter="setAuth")
     * @SerializedName("auth")
     * @Type("Zimbra\Admin\Struct\ExchangeAuthSpec")
     * @XmlElement(namespace="urn:zimbraAdmin")
     */
    private ?ExchangeAuthSpec $auth = NULL;

    /**
     * Constructor method for CheckExchangeAuthRequest
     * 
     * @param  ExchangeAuthSpec  $auth
     * @return self
     */
    public function __construct(?ExchangeAuthSpec $auth = NULL)
    {
        if ($auth instanceof ExchangeAuthSpec) {
            $this->setAuth($auth);
        }
    }

    /**
     * Set Exchange Auth
     *
     * @param  ExchangeAuthSpec $auth
     * @return self
     */
    public function setAuth(ExchangeAuthSpec $auth): self
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * Get Exchange Auth
     *
     * @return ExchangeAuthSpec
     */
    public function getAuth(): ?ExchangeAuthSpec
    {
        return $this->auth;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new CheckExchangeAuthEnvelope(
            new CheckExchangeAuthBody($this)
        );
    }
}
