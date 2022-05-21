# Odsetki
Kalkulator odsetek na podstawie https://kalkulatory.gofin.pl/kalkulatory/kalkulator-odsetek-ustawowych

Opis w języku polskim, gdyż biblioteka ma zastosowanie jedynie z naszymi przepisami

Przykład użycia:
```php
use Mrcnpdlk\Lib\Odsetki\OdsetkiUstawowe;

require __DIR__.'/../vendor/autoload.php';

$o = new OdsetkiUstawowe(
    '2015-12-31',
    '2021-01-10',
    10000
);

var_dump($o->calculate());
print_r($o->getDesc());
```

Rezultat:
```
double(3419.23)
Array
(
    [0] => Array
        (
            [0] => 2015-12-31 // OD
            [1] => 2015-12-31 // DO
            [2] => 0 // ILOSC DNI
            [3] => 0.08 // STAWKA 
            [4] => 0 // WYLICZONA KWOTA ZA OKRES
        )

    [1] => Array
        (
            [0] => 2016-01-01
            [1] => 2020-03-17
            [2] => 1538
            [3] => 0.07
            [4] => 2949.5890410959
        )

    [2] => Array
        (
            [0] => 2020-03-18
            [1] => 2020-04-08
            [2] => 22
            [3] => 0.065
            [4] => 39.178082191781
        )

    [3] => Array
        (
            [0] => 2020-04-09
            [1] => 2020-05-28
            [2] => 50
            [3] => 0.06
            [4] => 82.191780821918
        )

    [4] => Array
        (
            [0] => 2020-05-29
            [1] => 2021-01-10
            [2] => 227
            [3] => 0.056
            [4] => 348.27397260274
        )

)

```
