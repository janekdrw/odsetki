<?php
/**
 * Created by Marcin.
 * Date: 17.10.2020
 * Time: 21:26
 */

namespace Tests\Mrcnpdlk\Lib\Odsetki;

use Mrcnpdlk\Lib\Odsetki\OdsetkiUstawowe;
use PHPUnit\Framework\TestCase;

class OdsetkiUstawoweTest extends TestCase
{
    /**
     * @var mixed[]
     */
    private array $tValidCalculate;

    /**
     * @throws \Mrcnpdlk\Lib\Odsetki\Exception
     */
    public function testValidCalculate(): void
    {
        foreach ($this->tValidCalculate as [$deadlineDate, $paymentDate, $value]) {
            $obj = new OdsetkiUstawowe($deadlineDate, $paymentDate, 10000);
            self::assertEquals($value, $obj->calculate());
        }
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        parent::setUp();
        /*
         * Dane z: https://kalkulatory.gofin.pl/Kalkulator-odsetek-ustawowych,12.html
         */
        $this->tValidCalculate = [
            ['2015-01-01', '2021-01-10', 4214.85],
            ['2015-01-02', '2021-01-10', 4214.85],
            ['2015-01-03', '2021-01-10', 4212.65],
            ['2015-01-07', '2021-01-10', 4203.89],
            ['2015-12-31', '2021-01-10', 3419.23],
            ['2015-12-31', '2021-01-10', 3419.23],
            ['2016-01-01', '2021-01-10', 3415.39],
            ['2016-01-02', '2021-01-10', 3415.39],
            ['2016-01-03', '2021-01-10', 3411.56],
            ['2020-03-15', '2021-01-10', 471.56],
            ['2020-03-16', '2021-01-10', 471.56],
            ['2020-03-17', '2021-01-10', 469.64],
            ['2020-04-07', '2021-01-10', 432.24],
            ['2020-04-08', '2021-01-10', 430.46],
            ['2020-05-27', '2021-01-10', 349.91],
            ['2020-05-28', '2021-01-10', 348.27],
            ['2020-05-29', '2021-01-10', 346.74],
            ['2021-01-01', '2021-01-10', 9.21],
            ['2021-01-03', '2021-01-10', 9.21],
            ['2021-01-04', '2021-01-10', 9.21],
            ['2021-01-09', '2021-01-10', 0.0],
            ['2015-01-01', '2022-05-20', 5124.71],
            ['2015-01-02', '2022-05-20', 5124.71],
            ['2015-01-03', '2022-05-20', 5122.51],
        ];
    }
}
