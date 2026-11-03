<?php

require_once "clases/Habitacion.php";
require_once "clases/Huesped.php";
require_once "clases/Reserva.php";

session_start();

if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [
        13 => new Habitacion(13, "Cripta Real", 120, 2),
        66 => new Habitacion(66, "Laboratorio Frankenstein", 95, 3),
        99 => new Habitacion(99, "Sarcofago Imperial", 150, 2),
        404 => new Habitacion(404, "Suite Fantasmal", 80, 1),
        666 => new Habitacion(666, "Trono de Lucifer", 110, 2),
    ];
    $_SESSION["huespedes"] = [];
    $_SESSION["reservas"] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hotel Nocturna</title>
</head>
<body>
    <h1>Hotel Nocturna</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="habitaciones.php">Habitaciones</a>
        <a href="huespedes.php">Huespedes</a>
        <a href="reservas.php">Reservas</a>
    </nav>
    <main>

<p>Hotel terrorifico</p>

    </main>
</body>
</html>
