<?php
$estudiante = ['nombre' => 'Paco', 'edad' => 13, 'curso' => '2ESO'];

$clases = [ 'dataBase' => ['profesor' => 'Juanito', 'horas' => 3],
            'prog' => ['profesor' => 'Paco', 'horas' => 1]
          ];

echo $estudiante['nombre'] . "<br>";
echo $clases['dataBase']['profesor']. " horas " . $clases['dataBase']['horas'];

?>