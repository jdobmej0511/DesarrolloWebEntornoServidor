<?php

$nombre = $_POST["usuario"] ?? "";
$tema   = $_POST["tema"] ?? "";


# si nos envían datos desde el formulario, guardamos las cookies
if (!empty($nombre) and !empty($tema)):
    setcookie("usuario", $nombre, time() + (60 * 60 * 24 * 30));
    setcookie("tema", $tema, time() + (60 * 60 * 24 * 30));
endif;


# si se nos pide, RESETEAMOS las preferencias
if (isset($_GET["reset"])):
    setcookie("usuario", "", time() - (60 * 60 * 24 * 30));
    setcookie("tema", "", time() - (60 * 60 * 24 * 30));
else:

    # si tengo cookies guardadas, cojo los valores
    if (!empty($_COOKIE)):
        $nombre = $_COOKIE["usuario"];
        $tema = $_COOKIE["tema"];
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sesiones y Cookies - EJERCICIO 03</title>
    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" />

    <style>
        .claro { background-color: #f5f7f6; color: #1f2933; }
        .oscuro { background-color: #1e2723; color: #e8f0ec; }
        .calido { background-color: #fff1dc; color: #653c20; }
        .frio { background-color: #e8f3f8; color: #193a4a; }
    </style>
</head>

<body class="tema-<?= $tema??"" ?>";>

    <div class="container">
    
        <h3><?= isset($nombre)?: "Bienvenido/a, $nombre" ?></h3>

        <form action="EJ03T05corregido.php" method="post">
            <label for="usuario">Nombre de usuario:</label>
            <input id="usuario" class="form-control" type="text" name="usuario" autofocus required />

            <br/>

            <select class="form-control" name="tema">
                <option value="claro">Claro</option>
                <option value="oscuro">Oscuro</option>
                <option value="calido">Cálido</option>
                <option value="frio">Frío</option>
            </select>

            <br/>
            
            <button class="btn btn-primary">Enviar</button>
            
        </form>

        <a href= "EJ03T05corregido.php?reset">Resetear </a>
        
    </div>

</body>
</html>
