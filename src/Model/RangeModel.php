<?php
/**
 * Created by Marcin.
 * Date: 18.10.2020
 * Time: 03:31
 */

namespace Mrcnpdlk\Lib\Odsetki\Model;

use Mrcnpdlk\Lib\Odsetki\Date;

class RangeModel
{
    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Date
     */
    public Date $from;
    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Date|null
     */
    public ?Date $to;
    /**
     * @var float
     */
    public float $percent;

    /**
     * RangeModel constructor.
     *
     * @param Date  $from
     * @param Date  $to
     * @param float $percent
     */
    public function __construct(Date $from, Date $to, float $percent)
    {
        $this->from    = $from;
        $this->to      = $to;
        $this->percent = $percent;
    }

    /**
     * @param \Mrcnpdlk\Lib\Odsetki\Date $date
     *
     * @return bool
     */
    public function has(Date $date): bool
    {
        return $date->lte($this->to) && $date->gte($this->from);
    }
}
