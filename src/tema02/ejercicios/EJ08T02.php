<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8 Tema 2</title>
</head>
<body>
    <?php
        $puntuacion = 61;

        echo match (true) {
            $puntuacion < 50 => "Novato.",
            $puntuacion < 70 => "Intermedio.",
            $puntuacion < 90 => "Avanzado.",
            $puntuacion < 100 => "Experto.",
        }
    ?>
</body>
</html>