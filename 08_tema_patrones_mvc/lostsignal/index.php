<?php

require_once 'Senal.php';

$senales = [];
$error = null;

try {
    $senales = Senal::obtenerTodas();
} catch (PDOException $e) {
    $error = 'No se han podido consultar las señales.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lost Signal</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <?php require 'menu.php'; ?>
    <main class="container my-4">
        <h1 class="h3 mb-4">Señales registradas</h1>
        <?php if ($error !== null) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php else : ?>
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Estación</th>
                        <th>Frecuencia (MHz)</th>
                        <th>Intensidad</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($senales as $senal) : ?>
                        <tr class="<?= $senal->prioritaria ? 'table-warning' : '' ?>">
                            <td><?= htmlspecialchars($senal->codigo) ?></td>
                            <td><?= htmlspecialchars($senal->estacion) ?></td>
                            <td><?= number_format($senal->frecuencia, 3, ',', '.') ?></td>
                            <td><?= $senal->intensidad ?></td>
                            <td><?= $senal->estado->descripcion() ?></td>
                            <td>
                                <?php if ($senal->estado === EstadoSenal::Pendiente) : ?>
                                    <form method="post" action="analizar.php" class="d-inline">
                                        <input type="hidden" name="identificador" value="<?= $senal->identificador ?>">
                                        <button type="submit" name="accion" value="confirmar" class="btn btn-success btn-sm">Confirmar</button>
                                        <button type="submit" name="accion" value="descartar" class="btn btn-danger btn-sm">Descartar</button>
                                    </form>
                                <?php else : ?>
                                    —
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body>
</html>
