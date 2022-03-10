<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use Zimbra\Soap\Request;

/**
 * GetAllLocalesRequest class
 * Returns all locales defined in the system.  This is the same list returned by
 * java.util.Locale.getAvailableLocales(), sorted by display name (name attribute). 
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllLocalesRequest extends Request
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAllLocalesEnvelope)) {
            $this->envelope = new GetAllLocalesEnvelope(
                new GetAllLocalesBody($this)
            );
        }
    }
}
