<!-- t03_ej04.php Formulario con aficiones (checkbox) y país (select). Al enviar, muestra
el país y la lista de aficiones elegidas y conserva las marcas. -->

<?php
$aficiones = $_POST['aficiones'] ?? '';
$pais = $_POST['pais'] ?? '';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Aficiones y pais</h2>

    <form method="post">

        <label for="pais">Pais</label>
        <select name="pais" id="pais" required>
            <option value="">--Elige un pais--</option>
            <option value="España" <?= ($pais === 'España') ? 'selected' : ''  ?>>España</option>
            <option value="Portugal" <?= ($pais === 'Portugal') ? 'selected' : '' ?>>Portugal</option>
        </select><br>


        <input type="checkbox" id="juegos" name="aficiones[]" value="juegos">
        <label for="juegos">Aficiones</label><br>

        <input type="checkbox" id="peliculas" name="aficiones[]" value="peliculas">
        <label for="peliculas">Peliculas</label><br>

        <input type="checkbox" id="coches" name="aficiones[]" value="coches">
        <label for="coches">Coches</label><br>

        <button type="submit">Enviar</button>

    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <hr>
        <p><strong>Pais elegido: </strong><?= htmlspecialchars($pais) ?></p>

        <p>Aficiones elegidas:</p>
        <?php if (!empty($aficiones)): ?>
            <ul>
                <?php foreach ($aficiones as $aficion): ?>
                    <li><?= htmlspecialchars($aficion) ?></li>
                <?php endforeach ?>
            </ul>
        <?php else: ?>
            <p>No has seleccionado ninguna aficion</p>
        <?php endif ?>
    <?php endif ?>
</body>

</html>