<?php
/**
 * Created by Marcin.
 * Date: 17.10.2020
 * Time: 22:36
 */

namespace Mrcnpdlk\Lib\Odsetki;

use Carbon\Carbon;

/**
 * Immutable
 * Class Date
 */
class Date
{
    /**
     * @var \Carbon\Carbon
     */
    private $carbon;

    /**
     * Date constructor.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function __construct(int $year, int $month, int $day)
    {
        $this->carbon = Carbon::create($year, $month, $day);
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public static function create(int $year, int $month, int $day): Date
    {
        return new self($year, $month, $day);
    }

    /**
     * @param \Carbon\Carbon $carbon
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public static function createFromCarbon(Carbon $carbon): Date
    {
        return self::create($carbon->year, $carbon->month, $carbon->day);
    }

    /**
     * @param int $year
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public static function getCorpusChristi(int $year): Date
    {
        return self::getEaster($year)->addDays(60);
    }

    /**
     * @param int $year
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public static function getEaster(int $year): Date
    {
        return self::create($year, 3, 21)
                   ->addDays(easter_days($year))
            ;
    }

    /**
     * @param string $date
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public static function parse(string $date): Date
    {
        $c = Carbon::parse($date);

        return new self($c->year, $c->month, $c->day);
    }

    /**
     * @param int $days
     *
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public function addDays(int $days): Date
    {
        return self::createFromCarbon($this->carbon->addDays($days));
    }

    /**
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public function clone(): Date
    {
        return self::createFromCarbon($this->getCarbon());
    }

    /**
     * @param \Mrcnpdlk\Lib\Odsetki\Date $date
     *
     * @return bool
     */
    public function equal(Date $date): bool
    {
        return $this->getAsStr() === $date->getAsStr();
    }

    /**
     * @return string
     */
    public function getAsStr(): string
    {
        return $this->carbon->toDateString();
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getCarbon(): Carbon
    {
        return $this->carbon->clone();
    }

    /**
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    public function getNextWorkingDay(): Date
    {
        $currDay = $this->addDays(1);
        while ($currDay->isFreeDay()) {
            $currDay = $currDay->addDays(1);
        }

        return $currDay;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->carbon->year;
    }

    /**
     * @return bool
     */
    public function isFreeDay(): bool
    {
        return true === $this->carbon->isWeekend() // gdy weekend
            || $this->equal(self::create($this->getYear(), 1, 1)) // Nowy Rok
            || $this->equal(self::create($this->getYear(), 1, 6)) // Trzech Króli
            || $this->equal(self::create($this->getYear(), 5, 1))  // Święto Pracy
            || $this->equal(self::create($this->getYear(), 5, 3)) // Święto Konstytucji 3 Maja
            || $this->equal(self::create($this->getYear(), 8, 15)) // WNMP
            || $this->equal(self::create($this->getYear(), 11, 1)) // Wszystkich Świętych
            || $this->equal(self::create($this->getYear(), 11, 11)) // Dzień Niepodległości
            || $this->equal(self::create($this->getYear(), 12, 25)) // Pierwszy dzień Bożego Narodzenia
            || $this->equal(self::create($this->getYear(), 12, 26)) // Drugi dzień Bożego Narodzenia
            || $this->equal(self::getEaster($this->getYear())->addDays(1)) // Poniedziałek Wielkanocny
            || $this->equal(self::getCorpusChristi($this->getYear())) // Poniedziałek Wielkanocny
            ;
    }
}
