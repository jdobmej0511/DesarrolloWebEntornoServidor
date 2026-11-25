<?php
$notas = [7, 4, 9, 5, 3];
$suma = 0;
$total = 0;
$media = 0;
$aprobos = 0;

foreach ($notas as $nota) {
    $suma++;    

    $total += $nota;

    if ($nota >= 5) {
        $aprobos++;
    };
};

$media = $total / $suma;

echo "La media es $media y hay $aprobos aprobados.";
?>