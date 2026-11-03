<?php

require_once "../clases/Habitacion.php";
require_once "../clases/Huesped.php";
require_once "../clases/Reserva.php";

session_start();

if (isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"][13]->ocupar();
    echo "Cripta Real ocupada.";
} else {
    echo "Abre primero index.php.";
}
