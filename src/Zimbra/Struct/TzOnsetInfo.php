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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * TzOnsetInfo class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="info")
 */
class TzOnsetInfo
{
    /**
     * @Accessor(getter="getMonth", setter="setMonth")
     * @SerializedName("mon")
     * @Type("integer")
     * @XmlAttribute
     */
    private $month;

    /**
     * @Accessor(getter="getHour", setter="setHour")
     * @SerializedName("hour")
     * @Type("integer")
     * @XmlAttribute
     */
    private $hour;

    /**
     * @Accessor(getter="getMinute", setter="setMinute")
     * @SerializedName("min")
     * @Type("integer")
     * @XmlAttribute
     */
    private $minute;

    /**
     * @Accessor(getter="getSecond", setter="setSecond")
     * @SerializedName("sec")
     * @Type("integer")
     * @XmlAttribute
     */
    private $second;

    /**
     * @Accessor(getter="getDayOfMonth", setter="setDayOfMonth")
     * @SerializedName("mday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $dayOfMonth;

    /**
     * @Accessor(getter="getWeek", setter="setWeek")
     * @SerializedName("week")
     * @Type("integer")
     * @XmlAttribute
     */
    private $week;

    /**
     * @Accessor(getter="getDayOfWeek", setter="setDayOfWeek")
     * @SerializedName("wkday")
     * @Type("integer")
     * @XmlAttribute
     */
    private $dayOfWeek;

    /**
     * Constructor method for TzOnsetInfo
     * @param int $mon Month; 1=January, 2=February, etc.
     * @param int $hour Transition hour (0..23)
     * @param int $min Transition minute (0..59)
     * @param int $sec Transition second; 0..59, usually 0
     * @param int $mday Day of month (1..31)
     * @param int $week Week number; 1=first, 2=second, 3=third, 4=fourth, -1=last
     * @param int $wkday Day of week; 1=Sunday, 2=Monday, etc.
     * @return self
     */
    public function __construct(
        $mon,
        $hour,
        $min,
        $sec,
        $mday = NULL,
        $week = NULL,
        $wkday = NULL
    )
    {
        $this->setMonth($mon)
            ->setHour($hour)
            ->setMinute($min)
            ->setSecond($sec);

        if (is_int($mday) and in_array((int) $mday, range(1, 31))) {
            $this->setDayOfMonth($mday);
        }
        if (is_int($week) and in_array((int) $week, [-1, 1, 2, 3, 4])) {
            $this->setWeek($week);
        }
        if (is_int($wkday) and in_array((int) $wkday, range(1, 7))) {
            $this->setDayOfWeek((int) $wkday);
        }
    }

    /**
     * Gets month
     *
     * @return int
     */
    public function getMonth(): int
    {
        return $this->month;
    }

    /**
     * Sets month
     *
     * @param  int $mon
     * @return self
     */
    public function setMonth($mon): self
    {
        $mon = in_array((int) $mon, range(1, 12)) ? (int) $mon : 1;
        $this->month = $mon;
        return $this;
    }

    /**
     * Gets day of month
     *
     * @return int
     */
    public function getDayOfMonth(): ?int
    {
        return $this->dayOfMonth;
    }

    /**
     * Sets day of month
     *
     * @param  int $mday
     * @return self
     */
    public function setDayOfMonth($mday): self
    {
        $mday = in_array((int) $mday, range(1, 31)) ? (int) $mday : 1;
        $this->dayOfMonth = $mday;
        return $this;
    }

    /**
     * Gets hour
     *
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }

    /**
     * Sets hour
     *
     * @param  int $hour
     * @return self
     */
    public function setHour($hour): self
    {
        $hour = in_array((int) $hour, range(0, 23)) ? (int) $hour : 0;
        $this->hour = $hour;
        return $this;
    }

    /**
     * Gets minute
     *
     * @return int
     */
    public function getMinute(): int
    {
        return $this->minute;
    }

    /**
     * Sets minute
     *
     * @param  int $min
     * @return self
     */
    public function setMinute($min): self
    {
        $min = in_array((int) $min, range(0, 59)) ? (int) $min : 0;
        $this->minute = $min;
        return $this;
    }

    /**
     * Gets second
     *
     * @return int
     */
    public function getSecond(): int
    {
        return $this->second;
    }

    /**
     * Sets second
     *
     * @param  int $sec
     * @return self
     */
    public function setSecond($sec): self
    {
        $sec = in_array((int) $sec, range(0, 59)) ? (int) $sec : 0;
        $this->second = $sec;
        return $this;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    /**
     * Gets or sets week
     *
     * @param  int $week
     * @return int|self
     */
    public function setWeek($week): self
    {
        $week = in_array((int) $week, [-1, 1, 2, 3, 4]) ? (int) $week : -1;
        $this->week = $week;
        return $this;
    }

    /**
     * Gets day of week
     *
     * @return int
     */
    public function getDayOfWeek(): ?int
    {
        return $this->dayOfWeek;
    }

    /**
     * Gets or sets mon
     *
     * @param  int $wkday
     * @return self
     */
    public function setDayOfWeek($wkday): self
    {
        $wkday = in_array((int) $wkday, range(1, 7)) ? (int) $wkday : 1;
        $this->dayOfWeek = $wkday;
        return $this;
    }
}
