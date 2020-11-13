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
 * DedupAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DedupAction extends Enum
{
    /**
     * Constant for value 'start'
     * @return string 'start'
     */
    private const START = 'start';
    /**
     * Constant for value 'status'
     * @return string 'status'
     */
    private const STATUS = 'status';
    /**
     * Constant for value 'stop'
     * @return string 'stop'
     */
    private const STOP = 'stop';
    /**
     * Constant for value 'reset'
     * @return string 'reset'
     */
    private const RESET = 'reset';
}
