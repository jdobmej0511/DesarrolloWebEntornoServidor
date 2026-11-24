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
        <p>Oficina municipal de objetos perdidos</p>

        <p>Buscar por identificador</p>
        <form method="get" action="">
            <label for="id">Identificador</label>
            <input type="number" id="id" name="id" min="1" required value="<?= htmlspecialchars($id) ?>">
            <button type="submit">Buscar</button>
        </form>

        <p>Buscar por nombre o descripción</p>
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
                <p>Objetos encontrados: <?= count($resultados) ?></p>
                <ul>
                    <?php foreach ($resultados as $objeto): ?>
                        <li>
                            <?= $objeto["idObjeto"] ?> -
                            <?= htmlspecialchars($objeto["nombre"]) ?> -
                            <?= htmlspecialchars($objeto["descripcion"] ?? "") ?> -
                            <?= htmlspecialchars($objeto["lugar"]) ?> -
                            <?= date("d/m/Y", strtotime($objeto["fecha"])) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</body>
</html>
