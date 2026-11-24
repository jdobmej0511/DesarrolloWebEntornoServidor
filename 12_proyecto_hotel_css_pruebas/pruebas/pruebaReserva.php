<?php

require_once "../clases/Habitacion.php";
require_once "../clases/Huesped.php";
require_once "../clases/Reserva.php";

$cripta = new Habitacion(13, "Cripta Real", 120, 2);
$vlad = new Huesped(1, "Vlad", "Tepes", "666 000 001", "dracula@nocturna.com");
$victor = new Huesped(2, "Victor", "Frankenstein", "666 000 002", "frankenstein@nocturna.com");

$reserva = new Reserva(1, $vlad, $cripta, 3);

echo $reserva->huesped->nombre . "<br>";
echo $reserva->habitacion->nombre . "<br>";
echo $reserva->calcularImporte() . " €<br>";
echo $reserva->estado . "<br>";
var_dump($cripta->disponible);
echo "<br>";

try {
    $otra = new Reserva(2, $victor, $cripta, 2);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
}

$reserva->cancelar();
echo $reserva->estado . "<br>";
var_dump($cripta->disponible);
echo "<br>";

try {
    $reserva->cancelar();
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
}

try {
    $otra = new Reserva(3, $victor, $cripta, 0);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
}

var_dump($cripta->disponible);