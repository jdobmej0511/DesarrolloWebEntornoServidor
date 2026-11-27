<!-- 2. t03_ej02.php Pide dos números y muestra su multiplicación. Si alguno no es numérico,
muestra un error en vez del resultado. -->


<?php

$num1 = trim($_POST['num1'] ?? '');
$num2 = trim($_POST['num2'] ?? '');
$error = '';
$resultado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_numeric($num1) || !is_numeric($num2)) {
        $error = 'Introduce caracteres validos';
    } else {
        $resultado= $num1 * $num2;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method= "post">
        <input type="number" step="any" name="num1" value="<?= htmlspecialchars($num1) ?>" required>
        <input type="number" step="any" name="num2" value="<?= htmlspecialchars($num2) ?>" required>
        <button action="submit">multiplicar</button>
    </form>

    <?php if ($resultado !== ''): ?>
        <p>El resultado es: <?= $resultado ?></p>
    <?php endif ?>

</body>
</html>
