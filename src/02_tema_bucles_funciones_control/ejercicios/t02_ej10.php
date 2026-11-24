<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 Tema 2</title>
</head>
<body>
    <?php
        function esPrimo($numero) {
            if ($numero < 2) {
                return false;
            }

            for ($i = 2; $i * $i <= $numero; $i++) {
                if ($numero % $i == 0) {
                    return false; 
                }
            }
            return true; 
        }

        for ($num = 2; $num <= 100; $num++) {
            if (esPrimo($num)) {
                echo $num . " ";
            }
        }
    ?>
</body>
</html>