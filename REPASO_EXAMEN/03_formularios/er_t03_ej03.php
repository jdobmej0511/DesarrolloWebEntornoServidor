<!-- 3. t03_ej03.php Conversor de euros a pesetas (166,386), dólares (1,05), libras (0,87) o
yenes (157,25). La divisa se elige con radio y se conserva tras enviar. -->

<?php

$euros = trim($_POST['euros'] ?? '');
$divisa = $_POST['divisa'] ?? '';
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($euros !== '' && is_numeric($euros) && $divisa !== '') {
        $cantidad = (float)$euros;

        switch ($divisa) {
            case "pesetas":
                $resultado = $euros * 166.386;
                $mensaje = "$euros € son " . number_format($resultado, 2, ',', '.') . " pesetas.";
                break;
            case "dolares":
                $resultado = $euros * 1.05;
                $mensaje = "$euros € son " . number_format($resultado, 2, ',', '.') . " dólares.";
                break;
            case "libras":
                $resultado = $euros * 0.87;
                $mensaje = "$euros € son " . number_format($resultado, 2, ',', '.') . " libras.";
                break;
            case "yenes":
                $resultado = $euros * 157.25;
                $mensaje = "$euros € son " . number_format($resultado, 2, ',', '.') . " yenes.";
                break;
        }
    } else {
        $mensaje = "Por favor, introduce una euros válida y elige una divisa.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>t03_ej03.php</title>
</head>
<body>

    <form method="post">
        <label for="euros">Cantidad en euros €:</label>
        <input type="number" name="euros" id="euros"  step="any" required>
        <br/>

        <input type="radio" name="divisa" value="pesetas" id="pesetas" required>
        <label for="pesetas">Pesetas</label>
        <br>

        <input type="radio" name="divisa" value="dolares" id="dolares">
        <label for="dolares">Dolares</label>
        <br>

        <input type="radio" name="divisa" id="libras", value="libras">
        <label for="libras">Libras</label>
        <br>

        <input type="radio" name="divisa" id="yenes" value="yenes">
        <label for="yenes">Yenes</label>
        <br>

        <input type="submit" value="convertir">

    </form>

    <?php if ($mensaje !== ''): ?>
        <p><strong><?= htmlspecialchars($mensaje) ?></strong></p>
    <?php endif; ?>


</body>
</html>