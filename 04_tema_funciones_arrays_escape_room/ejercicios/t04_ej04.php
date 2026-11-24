<?php
function calcularPrecioFinal(float $precio, float $porcentaje): float
{
  return $precio - ($precio * $porcentaje / 100) ;
}

echo "Camiseta: " . calcularPrecioFinal(20, 10) . " €<br />" ;
echo "Zapatillas: " . calcularPrecioFinal(80, 25) . " €<br />" ;
echo "Mochila: " . calcularPrecioFinal(50, 20) . " €<br />" ;
