<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

/**
 * SingleDatesInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface SingleDatesInterface
{
    function setTimezone(string $timezone): self;
    function getTimezone(): ?string;

    function addDtVal(DtValInterface $dtVal): self;
    function setDtVals(array $dtVals): self;
    function getDtVals(): array;
}
