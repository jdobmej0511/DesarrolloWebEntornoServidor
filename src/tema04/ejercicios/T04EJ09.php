<?php
function calcularTotal(float $precio, float $iva = 21, float $descuento = 0): float
{
  $precio = $precio - ($precio * $descuento / 100) ;
  return $precio + ($precio * $iva / 100) ;
}

echo "Total: " . calcularTotal(100) . " €<br />" ;
echo "Total: " . calcularTotal(100, 10) . " €<br />" ;
echo "Total: " . calcularTotal(100, 21, 20) . " €<br />" ;
echo "Total: " . calcularTotal(100, descuento: 50) . " €<br />" ;
