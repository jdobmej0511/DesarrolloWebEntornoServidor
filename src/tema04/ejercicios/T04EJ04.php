<?php
function calcularPrecioFinal(float $precio, float $porcentaje): float
{
    return $precio - ($precio * $porcentaje / 100);
}

echo "Camiseta (20 €, 10%): " . number_format(calcularPrecioFinal(20, 10), 2, ',', '.') . " €<br>";
echo "Zapatillas (89.90 €, 25%): " . number_format(calcularPrecioFinal(89.90, 25), 2, ',', '.') . " €<br>";
echo "Mochila (45.50 €, 15%): " . number_format(calcularPrecioFinal(45.50, 15), 2, ',', '.') . " €<br>";
