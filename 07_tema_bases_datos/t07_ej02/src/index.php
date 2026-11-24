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
</head>
<body>
    <main>
        <h1>Oficina municipal de objetos perdidos</h1>

        <h2>Buscar por identificador</h2>
        <form method="get" action="">
            <label for="id">Identificador</label>
            <input type="number" id="id" name="id" min="1" required value="<?= htmlspecialchars($id) ?>">
            <button type="submit">Buscar</button>
        </form>

        <h2>Buscar por nombre o descripción</h2>
        <form method="get" action="">
            <label for="texto">Texto</label>
            <input type="text" id="texto" name="texto" required value="<?= htmlspecialchars($texto) ?>">
            <button type="submit">Buscar</button>
        </form>

        <?php if ($error !== null): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php elseif ($resultados !== null): ?>
            <?php if (count($resultados) === 0): ?>
                <p>No se ha encontrado ningún objeto que coincida con la búsqueda.</p>
            <?php else: ?>
                <p>Objetos encontrados: <strong><?= count($resultados) ?></strong></p>
                <table border="1">
                    <thead>
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
