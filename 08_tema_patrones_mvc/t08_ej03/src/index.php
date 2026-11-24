<?php

require __DIR__ . "/vendor/autoload.php";

use Senderismo\Controladores\RutaController;

$controlador = new RutaController;
$accion = $_GET["accion"] ?? "listar";

try {
    match ($accion) {
        "ver" => $controlador->ver(),
        default => $controlador->listar(),
    };
} catch (RuntimeException $e) {
    $controlador->error($e->getMessage());
}
