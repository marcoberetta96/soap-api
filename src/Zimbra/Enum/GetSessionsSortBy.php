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
 * GetSessionsSortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetSessionsSortBy extends Enum
{
    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    private const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    private const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'createdAsc'
     * @return string 'createdAsc'
     */
    private const CREATED_ASC = 'createdAsc';

    /**
     * Constant for value 'createdDesc'
     * @return string 'createdDesc'
     */
    private const CREATED_DESC = 'createdDesc';

    /**
     * Constant for value 'accessedAsc'
     * @return string 'accessedAsc'
     */
    private const ACCESSED_ASC = 'accessedAsc';

    /**
     * Constant for value 'accessedDesc'
     * @return string 'accessedDesc'
     */
    private const ACCESSED_DESC = 'accessedDesc';
}
