<?php
$nota = 90;

$resultado = match (true) {
    $nota >= 0 && $nota < 50 =>  'Suspenso',
    $nota >= 50 && $nota < 70 =>  'Aprobado',
    $nota >= 70 && $nota < 90 =>  'Notable',
    $nota >= 90 =>  'Sobresaliente',
    $nota < 0 || $nota > 100 =>  'Entrada invalida',
    default => 'Sobresaliente',
};

echo $resultado

?>