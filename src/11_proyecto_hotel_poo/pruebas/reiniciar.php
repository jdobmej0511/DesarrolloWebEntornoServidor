<?php

require_once "../clases/Habitacion.php";
require_once "../clases/Huesped.php";
require_once "../clases/Reserva.php";

session_start();

$_SESSION = [];
session_destroy();

echo "Sesion reiniciada.";
