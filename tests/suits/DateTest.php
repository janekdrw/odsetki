<?php
/**
 * Created by Marcin.
 * Date: 17.10.2020
 * Time: 21:26
 */

namespace Tests\Mrcnpdlk\Lib\Odsetki;

use Mrcnpdlk\Lib\Odsetki\Date;
use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @var string[]
     */
    private $tValidValues;

    public function testValidTable(): void
    {
        foreach ($this->tValidValues as $key => $value) {
            $origDate       = Date::parse($key);
            $nextWorkingDay = Date::parse($value);
            self::assertEquals($origDate->getNextWorkingDay()->getAsStr(), $nextWorkingDay->getAsStr());
        }
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->tValidValues = [
            '2019-12-30' => '2019-12-31',
            '2019-12-31' => '2020-01-02',
            '2020-01-01' => '2020-01-02',
            '2020-01-02' => '2020-01-03',
            '2020-01-03' => '2020-01-07',
            '2020-01-04' => '2020-01-07',
            '2020-01-05' => '2020-01-07',
            '2020-01-06' => '2020-01-07',
            '2020-04-11' => '2020-04-14',
            '2020-04-12' => '2020-04-14',
            '2020-04-13' => '2020-04-14',
            '2020-04-14' => '2020-04-15',
            '2020-04-15' => '2020-04-16',
            '2020-04-16' => '2020-04-17',
            '2020-04-17' => '2020-04-20',
            '2020-04-30' => '2020-05-04',
            '2020-12-23' => '2020-12-24',
            '2020-12-24' => '2020-12-28',
        ];
    }
}
