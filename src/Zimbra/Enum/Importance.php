<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * Importance enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class Importance extends Enum
{
    /**
     * Constant for value 'high'
     * @return string 'high'
     */
    private const HIGH = 'high';

    /**
     * Constant for value 'normal'
     * @return string 'normal'
     */
    private const NORMAL = 'normal';

    /**
     * Constant for value 'low'
     * @return string 'low'
     */
    private const LOW = 'low';
}
