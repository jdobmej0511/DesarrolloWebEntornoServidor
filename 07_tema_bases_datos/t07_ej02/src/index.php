<?php

require_once "funciones.php";

$id = $_GET["id"] ?? "";
$texto = trim($_GET["texto"] ?? "");
$error = null;
$resultados = null;

try {
    $pdo = conectar();

    if (isset($_GET["id"])) {
        $idValido = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);

        if ($idValido === false) {
            $error = "El identificador debe ser un número entero mayor que cero.";
        } else {
            $objeto = buscarPorIdentificador($pdo, $idValido);
            $resultados = $objeto === false ? [] : [$objeto];
        }
    } elseif (isset($_GET["texto"])) {
        if ($texto === "") {
            $error = "Introduce un texto para buscar.";
        } else {
            $resultados = buscarPorTexto($pdo, $texto);
        }
    }
} catch (PDOException $e) {
    $error = "Se ha producido un error al consultar la base de datos.";
} catch (RuntimeException $e) {
    $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objetos perdidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <main class="container py-4">
        <h1 class="mb-4">Oficina municipal de objetos perdidos</h1>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <form method="get" action="" class="card card-body">
                    <h2 class="h5">Buscar por identificador</h2>
                    <label for="id" class="form-label">Identificador</label>
                    <input type="number" id="id" name="id" min="1" required class="form-control mb-3" value="<?= htmlspecialchars($id) ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <div class="col-md-6">
                <form method="get" action="" class="card card-body">
                    <h2 class="h5">Buscar por nombre o descripción</h2>
                    <label for="texto" class="form-label">Texto</label>
                    <input type="text" id="texto" name="texto" required class="form-control mb-3" value="<?= htmlspecialchars($texto) ?>">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>

        <?php if ($error !== null): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php elseif ($resultados !== null): ?>
            <?php if (count($resultados) === 0): ?>
                <div class="alert alert-info">No se ha encontrado ningún objeto que coincida con la búsqueda.</div>
            <?php else: ?>
                <p>Objetos encontrados: <strong><?= count($resultados) ?></strong></p>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Lugar</th>
                            <th>Fecha de recogida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $objeto): ?>
                            <tr>
                                <td><?= $objeto["idObjeto"] ?></td>
                                <td><?= htmlspecialchars($objeto["nombre"]) ?></td>
                                <td><?= htmlspecialchars($objeto["descripcion"] ?? "") ?></td>
                                <td><?= htmlspecialchars($objeto["lugar"]) ?></td>
                                <td><?= date("d/m/Y", strtotime($objeto["fecha"])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</body>
</html>
