<?php
/**
 * Created by Marcin.
 * Date: 17.10.2020
 * Time: 21:27
 */

namespace Mrcnpdlk\Lib\Odsetki;

use Mrcnpdlk\Lib\Odsetki\Model\RangeModel;

class Odsetki
{
    /**
     * @var array[]
     */
    private static $tDef = [
        ['2014-12-23', 0.08],
        ['2016-01-01', 0.07],
        ['2020-03-18', 0.065],
        ['2020-04-09', 0.06],
        ['2020-05-29', 0.056],
    ];

    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Date
     */
    private $deadlineDate;
    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Date
     */
    private $paymentDate;
    /**
     * @var float
     */
    private $value;
    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Model\RangeModel[]
     */
    private $ranges;

    /**
     * Odsetki constructor.
     *
     * @param string $deadlineDate
     * @param string $paymentDate
     * @param float  $value
     *
     * @throws \Mrcnpdlk\Lib\Odsetki\Exception
     */
    public function __construct(string $deadlineDate, string $paymentDate, float $value = 1.0)
    {
        $this->deadlineDate = Date::parse($deadlineDate);
        $this->paymentDate  = Date::parse($paymentDate);
        $this->value        = $value;

        if ($this->getFirstRange()->getCarbon()->greaterThan($this->deadlineDate->getCarbon())) {
            throw new Exception(sprintf('Data terminu zapłaty %s jest mniejsza niż zdefiniowany początkowy zakres wartości odsetek %s', $this->deadlineDate->getAsStr(), $this->getFirstRange()->getAsStr()));
        }
        if ($this->deadlineDate->getCarbon()->greaterThan($this->paymentDate->getCarbon())) {
            throw new Exception(sprintf('Data terminu zapłaty %s musi byc mniejsza niż data uiszczenia zapłaty %s', $this->deadlineDate->getAsStr(), $this->paymentDate->getAsStr()));
        }
        foreach (static::$tDef as $k => $v) {
            $this->ranges[] = new RangeModel(
                $v[0],
                isset(static::$tDef[$k + 1]) ? static::$tDef[$k + 1][0] : null,
                $v[1]);
        }
    }

    public function calculate()
    {
        $tRes = [];
        foreach ($this->ranges as  $range) {
        }
    }

    /**
     * @return \Mrcnpdlk\Lib\Odsetki\Date
     */
    private function getFirstRange(): Date
    {
        return Date::parse(static::$tDef[0][0]);
    }
}
