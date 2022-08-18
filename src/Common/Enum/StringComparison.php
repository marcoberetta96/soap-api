<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

/**
 * StringComparison enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum StringComparison: string
{
    /**
     * Constant for value 'is'
     * @return string 'is'
     */
    case IS = 'is';

    /**
     * Constant for value 'contains'
     * @return string 'contains'
     */
    case CONTAINS = 'contains';

    /**
     * Constant for value 'matches'
     * @return string 'matches'
     */
    case MATCHES = 'matches';
}
