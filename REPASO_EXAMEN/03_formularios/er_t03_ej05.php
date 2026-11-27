<!-- 5. t03_ej05.php Un botón "Pulsar" y el texto "Has pulsado N veces". Guarda el contador
en un campo hidden . -->

<?php  

$contador = $_POST['contador'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contador = (int)$contador + 1;
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
    
    <p>Has pulsado <?= $contador ?> veces</p>

    <form method="post">

        <input type="hidden" name="contador" value="<?= $contador ?>">
        <button action = "submit">Pulsa</button>
    </form>

</body>
</html>