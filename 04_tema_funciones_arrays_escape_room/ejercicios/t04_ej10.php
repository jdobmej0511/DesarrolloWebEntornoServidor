<?php
function calcularReserva(float $precioNoche, int $noches, int $habitaciones = 1): float
{
  return $precioNoche * $noches * $habitaciones ;
}

echo "Reserva: " . calcularReserva(80, 3) . " €<br />" ;
echo "Reserva: " . calcularReserva(80, 3, 2) . " €<br />" ;
