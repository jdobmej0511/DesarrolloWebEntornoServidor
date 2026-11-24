<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio Tablero de Juego</title>
    <style>
        /* Estilos base del tablero */
        table { border: 1px solid #000; border-collapse: collapse; }
        td { text-align: center; font-weight: bold; padding: 10px; border: 1px solid #ccc; }

        /* Colores del texto según par/impar */
        .par { color: #4287f5; }
        .impar { color: #fa0505; }

        /* NUEVO: Fondo gris para el patrón de tablero de ajedrez */
        .fondo { background-color: #ddd; }
    </style>
</head>

<body>
    <?php
    const SIMBOLOS = ["💎", "💥", "🔒", "🔑"];

    if (isset($_POST["posiciones"])) {

        $posiciones = explode(",", $_POST["posiciones"]);
        $tieneLlave = $_POST["tieneLlave"] == "1";
        $fin = $_POST["fin"] == "1";
        $casilla = (int) $_POST["casilla"];

    } else {

        $posiciones = [];


        for ($i = 1; $i <= 4; $i++):
            do {
                $valor = rand(1, 100);
            } while (in_array($valor, $posiciones));

            $posiciones[] = $valor;
        endfor;

        $tieneLlave = false;
        $fin = false;
        $mensaje = "";
    }
    ?>

    <table>
        <tbody>
            <?php
            $numero = 1;

            for ($fil = 1; $fil <= 10; $fil++):
                echo "<tr>";

                for ($col = 1; $col <= 10; $col++):

                    $clase = ($numero % 2 == 0) ? "par" : "impar";

                    $indice = array_search($numero, $posiciones);
                    $valor = match($indice) {
                        0, 1, 2, 3 => SIMBOLOS[$indice],
                        default => str_pad($numero, 3, "0", STR_PAD_LEFT)
                    };

                    $clase .= (($fil + $col) % 2 == 0) ? " fondo" : "";

                    echo "<td class=\"{$clase}\">{$valor}</td>\n";

                    $numero++;
                endfor;

                echo "</tr>";
            endfor;
            ?>
        </tbody>
    </table>

    <form method="post">
        <input type="hidden" name="posiciones" value="<?= implode(",", $posiciones) ?>">
        <input type="hidden" name="tieneLlave" value="<?= $tieneLlave ? 1 : 0 ?>">
        <input type="hidden" name="fin" value="<?= $fin ? 1 : 0 ?>">

        <label for="casilla">Casilla (1-100):</label>
        <input type="number" name="casilla" id="casilla" min="1" max="100" required>
        <button type="submit">Enviar</button>

        <button onclick = "location.href"></button>
    </form>
</body>
</html>