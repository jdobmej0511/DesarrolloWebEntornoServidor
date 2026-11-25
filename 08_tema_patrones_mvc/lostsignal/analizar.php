<?php

require_once 'Senal.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identificador = filter_var($_POST['identificador'] ?? null, FILTER_VALIDATE_INT);
    $accion = $_POST['accion'] ?? '';

    if ($identificador !== false) {
        try {
            $senal = Senal::buscar($identificador);

            if ($senal !== null) {
                match ($accion) {
                    'confirmar' => $senal->confirmar(),
                    'descartar' => $senal->descartar(),
                    default => false,
                };
            }
        } catch (PDOException $e) {
        }
    }
}

header('Location: index.php');
exit;
