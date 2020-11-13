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
 * QuotaSortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class QuotaSortBy extends Enum
{
    /**
     * Constant for value 'percentUsed'
     * @return string 'percentUsed'
     */
    private const PERCENT_USED = 'percentUsed';

    /**
     * Constant for value 'totalUsed'
     * @return string 'totalUsed'
     */
    private const TOTAL_USED = 'totalUsed';

    /**
     * Constant for value 'quotaLimit'
     * @return string 'quotaLimit'
     */
    private const QUOTA_LIMIT = 'quotaLimit';
}
