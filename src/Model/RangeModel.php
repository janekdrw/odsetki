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
    public $from;
    /**
     * @var \Mrcnpdlk\Lib\Odsetki\Date|null
     */
    public $to;
    /**
     * @var float
     */
    public $percent;

    /**
     * RangeModel constructor.
     *
     * @param string $from
     * @param string $to
     * @param float  $percent
     */
    public function __construct(string $from, ?string $to, float $percent)
    {
        $this->from    = Date::parse($from);
        $this->to      = null === $to ? null : Date::parse($to);
        $this->percent = $percent;
    }
}
