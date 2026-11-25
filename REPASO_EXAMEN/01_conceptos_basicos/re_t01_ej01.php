<?php
const IVA = 0.21;

$precio = 80;
$total = $precio * IVA + $precio;

echo "EL precio con IVA es {$total}" ;
$frase = 'Total calculado. ';
$frase .= 'Gracias por su compra';
echo '<br>' . $frase;
