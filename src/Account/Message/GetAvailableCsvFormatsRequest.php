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
 * GetAvailableCsvFormatsRequest class
 * Returns the known CSV formats that can be used for import and export of addressbook.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAvailableCsvFormatsRequest extends Request
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAvailableCsvFormatsEnvelope)) {
            $this->envelope = new GetAvailableCsvFormatsEnvelope(
                new GetAvailableCsvFormatsBody($this)
            );
        }
    }
}
