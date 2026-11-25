<?php

require_once 'Senal.php';

$codigo = '';
$estacion = '';
$frecuencia = '';
$intensidad = '';
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = trim($_POST['codigo'] ?? '');
    $estacion = trim($_POST['estacion'] ?? '');
    $frecuencia = trim($_POST['frecuencia'] ?? '');
    $intensidad = trim($_POST['intensidad'] ?? '');

    try {
        if ($codigo === '' || strlen($codigo) > 20) {
            throw new InvalidArgumentException('El código es obligatorio y no puede superar los 20 caracteres.');
        }

        if ($estacion === '' || strlen($estacion) > 100) {
            throw new InvalidArgumentException('La estación es obligatoria y no puede superar los 100 caracteres.');
        }

        $frecuenciaNumero = filter_var($frecuencia, FILTER_VALIDATE_FLOAT);
        if ($frecuenciaNumero === false) {
            throw new InvalidArgumentException('La frecuencia debe ser un número.');
        }

        $intensidadNumero = filter_var($intensidad, FILTER_VALIDATE_INT);
        if ($intensidadNumero === false) {
            throw new InvalidArgumentException('La intensidad debe ser un número entero.');
        }

        if (existeCodigo($codigo)) {
            throw new InvalidArgumentException("Ya existe una señal con el código $codigo.");
        }

        $senal = new Senal($codigo, $estacion, $frecuenciaNumero, $intensidadNumero);
        $senal->guardar();

        header('Location: index.php');
        exit;
    } catch (InvalidArgumentException $e) {
        $error = $e->getMessage();
    } catch (PDOException $e) {
        $error = 'No se ha podido registrar la señal.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar señal - Lost Signal</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <?php require 'menu.php'; ?>
    <main class="container my-4">
        <h1 class="h3 mb-4">Registrar señal</h1>
        <?php if ($error !== null) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="registrar.php">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" maxlength="20" required value="<?= htmlspecialchars($codigo) ?>">
            </div>
            <div class="mb-3">
                <label for="estacion" class="form-label">Estación</label>
                <input type="text" class="form-control" id="estacion" name="estacion" maxlength="100" required value="<?= htmlspecialchars($estacion) ?>">
            </div>
            <div class="mb-3">
                <label for="frecuencia" class="form-label">Frecuencia (MHz)</label>
                <input type="number" class="form-control" id="frecuencia" name="frecuencia" min="0.001" step="0.001" required value="<?= htmlspecialchars($frecuencia) ?>">
            </div>
            <div class="mb-3">
                <label for="intensidad" class="form-label">Intensidad</label>
                <input type="number" class="form-control" id="intensidad" name="intensidad" min="1" max="100" step="1" required value="<?= htmlspecialchars($intensidad) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </main>
</body>
</html>
