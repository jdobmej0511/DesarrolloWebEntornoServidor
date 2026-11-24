<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 Tema 2</title>
</head>
<body>
    <?php
        $temperatura = 20;
        if ($temperatura < 10) {
            echo "Hace frio.";
        } else if ($temperatura >= 10 && $temperatura <= 20){
            echo "Esta templado";
        } else {
            echo "Hace calor.";
        }
        
    ?>
</body>
</html>