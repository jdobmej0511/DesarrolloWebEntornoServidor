<!-- 1. t03_ej01.php Pide nombre y apellidos y muestra un saludo personalizado. El
formulario sigue visible y conserva los valores. -->

<?php
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$saludo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $nombre !== '' && $apellido !== '') {
    $saludo = 'Hola ' . htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T03 EJ01</title>
</head>
<body>
    <form action="er_t03_ej01.php" method = 'post'>
        <input type="text" name='nombre' value='<?= htmlspecialchars($nombre) ?>' required>
        <input type="text" name= "apellido" value="<?= htmlspecialchars($apellido) ?>" required>
        <button type="submit">Saludar</button>
    </form>

    <?php if ($saludo !== ''): ?>
        <p><?= $saludo ?></p>
    <?php endif ?>
</body>
</html>