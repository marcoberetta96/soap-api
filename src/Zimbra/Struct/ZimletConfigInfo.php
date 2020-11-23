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
 * ZimletConfigInfo interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface ZimletConfigInfo
{
    function setName($name): self;
    function setVersion($version): self;
    function setDescription($description): self;
    function setExtension($extension): self;
    function setTarget($target): self;
    function setLabel($label): self;
    function setGlobal(ZimletGlobalConfigInfo $global): self;
    function setHost(ZimletHostConfigInfo $host): self;

    function getName(): ?string;
    function getVersion(): ?string;
    function getDescription(): ?string;
    function getExtension(): ?string;
    function getTarget(): ?string;
    function getLabel(): ?string;
    function getGlobal(): ZimletGlobalConfigInfo;
    function getHost(): ZimletHostConfigInfo;
}
