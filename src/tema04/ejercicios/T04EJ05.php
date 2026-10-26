<?php
function celsiusAFahrenheit(float $celsius): float
{
    return $celsius * 9 / 5 + 32;
}

echo "25 ºC = " . celsiusAFahrenheit(25) . " ºF<br>";
echo "30 ºC = " . celsiusAFahrenheit(30) . " ºF<br>";
echo "18.5 ºC = " . celsiusAFahrenheit(18.5) . " ºF<br>";

echo "Tipo devuelto con 25: " . gettype(celsiusAFahrenheit(25)) . "<br>";
echo "Con el string \"25\": " . celsiusAFahrenheit("25") . " ºF<br>";

try {
    echo celsiusAFahrenheit("hola");
} catch (TypeError $e) {
    echo "Con \"hola\": " . $e->getMessage() . "<br>";
}
