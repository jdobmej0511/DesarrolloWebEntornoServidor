<?php
function celsiusAFahrenheit(float $celsius): float
{
  return $celsius * 9 / 5 + 32 ;
}

echo "25 ºC = " . celsiusAFahrenheit(25) . " ºF<br />" ;
echo "30 ºC = " . celsiusAFahrenheit(30) . " ºF<br />" ;
echo "18.5 ºC = " . celsiusAFahrenheit(18.5) . " ºF<br />" ;
echo "\"25\" ºC = " . celsiusAFahrenheit("25") . " ºF<br />" ;
echo "\"veinticinco\" ºC = " . celsiusAFahrenheit("veinticinco") . " ºF<br />" ;
