<?php

    # recuperamos la fecha y hora de la ultima visita 
    $ultimaVisita = $_COOKIE["visita"]??"" ;

    # setcookie("visita") ;
    $infoHora = date("d/m/y H:i:s") ;

    # guardamos / actualizamos al cookie con la hora de visita ACTUAL
    setcookie("visita", $infoHora);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Sesiones y Cookies - EJERCICIO 03</title>
    <meta charset="utf-8" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" />

</head>

<body>

    <div class="container">

        <p><?= empty($ultimaVisita)?"Esta es tu primera visita":$ultimaVisita ?></p>

    </div>

</body>
</html>
