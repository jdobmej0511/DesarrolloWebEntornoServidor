<?php
    require_once "mocturna.php";

    if($_POST):

        $huesped = $_POST["huesped"];
        $precio = $_POST["precio"];
        $noches = $_POST["noches"];

        $preio = calcularEstancia($precio, $noches);

        if ($precio === false) 
            $mensaje = "El precio por noche y el numero de noches debe ser positivo"
        else:
            $mensaje
    endif;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Terrorifico</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <label for="huesped">Nombre del huésped:</label>
            <input id="huesped" name="huesped" type="text" autofocus required />

            <br>

            <label for="huesped">Nombre del huésped:</label>
            <input id="huesped" name="huesped" type="text" autofocus required />

            <label for="huesped">Nombre del huésped:</label>
            <input id="huesped" name="huesped" type="text" autofocus required />

            <br>


        </form>
    
    </div>
</body>
</html>