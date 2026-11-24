<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15 b Tema 2</title>
</head>
<body>
    <?php
        $dividiendo = 6;
        $divisor = 0;

        try {
            echo ($dividiendo / $divisor);
        } catch (DivisionByZeroError $dbz) {
            echo "Error al realizar la operación.";
        } finally {
            echo "<br/>Operación finalizada."; 
        }
    ?>
</body>
</html>