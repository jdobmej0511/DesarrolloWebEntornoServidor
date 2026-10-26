<?php
function calcularArea(float $base, float $altura): float
{
    return $base * $altura;
}

echo "Rectángulo 4 x 5: " . calcularArea(4, 5) . "<br>";
echo "Rectángulo 10 x 2.5: " . calcularArea(10, 2.5) . "<br>";
echo "Rectángulo 7.2 x 3: " . calcularArea(7.2, 3) . "<br>";
