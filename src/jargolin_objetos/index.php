<?php
    $habitaciones = [
    ["numero" => 13, "nombre" => "Cripta real", "precio" => 120, "capacidad" => 2, "disponible" => true],
    ["numero" => 66, "nombre" => "Laboratorio Frankenstein", "precio" => 95, "capacidad" => 3, "disponible" => true],
    ["numero" => 99, "nombre" => "Sarcofago Imperial", "precio" => 150, "capacidad" => 2, "disponible" => true],
    ["numero" => 404, "nombre" => "Suite Fantasmal", "precio" => 80, "capacidad" => 1, "disponible" => true],
    ["numero" => 666, "nombre" => "Guarida del Hombre Lobo", "precio" => 110, "capacidad" => 2, "disponible" => false]
];

function aumentoCapacidad (int $capacidad) {
    return $capacidad + 1;
}

$foo = function(Habitacion $item){
    $item->capacidad++;

    return $item;
}

$suma = array_map();
?>