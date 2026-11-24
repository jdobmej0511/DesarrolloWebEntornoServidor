<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15 Tema 2</title>
</head>
<body>
    <?php
        $persona = [
            "nombre" => "Jose",
            "edad" => "18",
            "ciudad" => "Málaga",
        ] ;

        foreach ($persona as $clave => $valor) {
            echo "$clave = $valor<br/>" ;
        }
    ?>
</body>
</html>