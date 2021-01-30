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

use JMS\Serializer\Annotation\{AccessType, XmlRoot};

use Zimbra\Struct\KeyValuePairs;

/**
 * MailKeyValuePairs class
 *
 * @package   Zimbra
 * @subpackage Mail
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="kvp")
 */
class MailKeyValuePairs implements KeyValuePairs
{
    use MailKeyValuePairsTrait;

    /**
     * Constructor method for MailKeyValuePairs
     *
     * @param array $keyValuePairs
     */
    public function __construct(array $keyValuePairs = [])
    {
        $this->setKeyValuePairs($keyValuePairs);
    }
}
