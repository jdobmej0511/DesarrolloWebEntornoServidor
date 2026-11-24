<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercio 16 Tema 2</title>
</head>
<body>
    <?php
        $notas = [1.5, 4, 8.2, 6, 3.5, 9, 5.5, 4.8];
        $aprobados = 0;
        $suspensos = 0;

        foreach ($notas as $clave => $valor) {
            echo $valor;
            if ($valor > 5) {
                echo " = aprobado<br>" ;
                $aprobados++;
                } else {
                echo " = suspenso<br>";
                $suspensos++;
            }    
        }

        echo "<br>Aprobados = $aprobados<br>";
        echo "Suspensos = $suspensos<br>";
    ?>
</body>
</html>