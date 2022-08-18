<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};
use Zimbra\Common\Struct\Id;

/**
 * TzReplaceInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TzReplaceInfo
{
    /**
     * TzID from /opt/zimbra/conf/timezones.ics 
     * 
     * @var Id
     */
    #[Accessor(getter: 'getWellKnownTz', setter: 'setWellKnownTz')]
    #[SerializedName('wellKnownTz')]
    #[Type(Id::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $wellKnownTz;

    /**
     * Timezone
     * 
     * @var CalTZInfo
     */
    #[Accessor(getter: 'getCalTz', setter: 'setCalTz')]
    #[SerializedName('tz')]
    #[Type(CalTZInfo::class)]
    #[XmlElement(namespace: 'urn:zimbraAdmin')]
    private $calTz;

    /**
     * Constructor
     * 
     * @param Id $wellKnownTz
     * @param CalTZInfo $tz
     * @return self
     */
    public function __construct(?Id $wellKnownTz = NULL, ?CalTZInfo $tz = NULL)
    {
        if ($wellKnownTz instanceof Id) {
            $this->setWellKnownTz($wellKnownTz);
        }
        if ($tz instanceof CalTZInfo) {
            $this->setCalTz($tz);
        }
    }

    /**
     * Get the wellKnownTz.
     *
     * @return Id
     */
    public function getWellKnownTz(): ?Id
    {
        return $this->wellKnownTz;
    }

    /**
     * Set the wellKnownTz.
     *
     * @param  Id $wellKnownTz
     * @return self
     */
    public function setWellKnownTz(Id $wellKnownTz): self
    {
        $this->wellKnownTz = $wellKnownTz;
        return $this;
    }

    /**
     * Get the tz.
     *
     * @return CalTZInfo
     */
    public function getCalTz(): ?CalTZInfo
    {
        return $this->calTz;
    }

    /**
     * Set the tz.
     *
     * @param  CalTZInfo $tz
     * @return self
     */
    public function setCalTz(CalTZInfo $tz): self
    {
        $this->calTz = $tz;
        return $this;
    }
}
