<?php

require_once "../clases/Huesped.php";

$huespedes = [
    new Huesped(1, "Vlad", "Tepes", "666 000 001", "dracula@nocturna.com"),
    new Huesped(2, "Victor", "Frankenstein", "666 000 002", "frankenstein@nocturna.com"),
    new Huesped(3, "Morticia", "Addams", "666 000 003", "morticia@nocturna.com"),
    new Huesped(4, "Larry", "Talbot", "666 000 004", "hombrelobo@nocturna.com"),
    new Huesped(5, "Jack", "Griffin", "666 000 004", "invisible@nocturna.com"),
];

foreach ($huespedes as $huesped) {
    echo $huesped->imprimir();
}

$morticia = $huespedes[2];

$morticia->nombre = "Lily Munster";
echo $morticia->pila . "<br>";
echo $morticia->apellidos . "<br>";
echo $morticia->nombre . "<br>";

$morticia->nombre = "Mary Shelley Godwin";
echo $morticia->pila . "<br>";
echo $morticia->apellidos . "<br>";

try {
    $morticia->nombre = "Imhotep";
} catch (InvalidArgumentException $e) {
    echo $e->getMessage() . "<br>";
}

echo $morticia->nombre . "<br>";