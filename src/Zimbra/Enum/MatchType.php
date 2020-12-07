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
 * MatchType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MatchType extends Enum
{
    /**
     * Constant for value 'is'
     * @return string 'is'
     */
    private const IS = 'is';

    /**
     * Constant for value 'contains'
     * @return string 'contains'
     */
    private const CONTAINS = 'contains';

    /**
     * Constant for value 'matches'
     * @return string 'matches'
     */
    private const MATCHES = 'matches';

    /**
     * Constant for value 'count'
     * @return string 'count'
     */
    private const COUNT = 'count';

    /**
     * Constant for value 'value'
     * @return string 'value'
     */
    private const VALUE = 'value';
}
