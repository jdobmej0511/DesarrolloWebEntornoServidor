<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 Tema 2</title>
</head>
<body>
    <?php
        $dia = 2;

        switch ($dia) {
            case 1:
                echo "Lunes.";
                break;

            case 2:
                echo "Martes.";
                break;

            case 3:
                echo "Miercoles.";
                break;

            case 4:
                echo "Jueves.";
                break;

            case 5:
                echo "Viernes.";
                break;

            case 6:
                echo "Sabado.";
                break;

            case 7:
                echo "Domingo.";
                break;
            
            default:
                echo "Ese valor no corresponde con ningun dia";
                break;
        }
    ?>
</body>
</html>