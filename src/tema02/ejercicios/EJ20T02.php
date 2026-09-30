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
        .impar { color: #7e42f5; }

        /* NUEVO: Fondo gris para el patrón de tablero de ajedrez */
        .fondo { background-color: #ddd; }
    </style>
</head>

<body>
    <?php
    # Definimos la constante con los iconos del juego
    # Índices: 0 = diamante, 1 = trampa, 2 = cofre, 3 = llave
    const SIMBOLOS = ["💎", "💥", "🔒", "🔑"];

    if (isset($_POST["posiciones"])) {
        # NUEVO: se ha enviado el formulario, recuperamos el estado del juego
        $posiciones = explode(",", $_POST["posiciones"]);
        $tieneLlave = $_POST["tieneLlave"] == "1";
        $fin = $_POST["fin"] == "1";
        $casilla = (int) $_POST["casilla"];

        if ($fin) {
            $mensaje = "La partida ha terminado. Recarga la página para jugar otra vez.";
        } elseif ($casilla < 1 || $casilla > 100) {
            $mensaje = "Introduce un número entre 1 y 100.";
        } elseif ($casilla == $posiciones[0]) {
            # a) Diamante: el juego termina y el jugador gana
            $mensaje = "💎 ¡Has encontrado el diamante! Has ganado.";
            $fin = true;
        } elseif ($casilla == $posiciones[1]) {
            # b) Trampa: el juego termina y el jugador pierde
            $mensaje = "💥 ¡Has caído en la trampa! Has perdido.";
            $fin = true;
        } elseif ($casilla == $posiciones[3]) {
            # c) Llave: el juego continúa y se guarda en el inventario
            $tieneLlave = true;
            $mensaje = "🔑 Has encontrado la llave. Se guarda en tu inventario.";
        } elseif ($casilla == $posiciones[2]) {
            # d) Cofre: depende de si hay llave en el inventario
            if ($tieneLlave) {
                $mensaje = "🎁 ¡Has abierto el cofre! Has ganado un premio.";
            } else {
                $mensaje = "🔒 El cofre está cerrado. Necesitas una llave.";
            }
        } else {
            $mensaje = "Casilla vacía. Sigue buscando.";
        }
    } else {
        # Inicializamos el array de posiciones
        $posiciones = [];

        # Colocamos las 4 posiciones aleatorias de forma única
        for ($i = 1; $i <= 4; $i++):
            do {
                $valor = rand(1, 100);
            } while (in_array($valor, $posiciones));

            # Guardamos el valor obtenido
            $posiciones[] = $valor;
        endfor;

        # NUEVO: estado inicial del juego
        $tieneLlave = false;
        $fin = false;
        $mensaje = "";
    }
    ?>

    <table>
        <tbody>
            <?php
            $numero = 1;

            # Bucle para las 10 filas
            for ($fil = 1; $fil <= 10; $fil++):
                echo "<tr>";

                # Bucle para las 10 columnas de cada fila
                for ($col = 1; $col <= 10; $col++):

                    # Determinamos la clase según el número (par o impar)
                    $clase = ($numero % 2 == 0) ? "par" : "impar";

                    # Comprobamos si el número actual contiene un símbolo especial
                    $indice = array_search($numero, $posiciones);
                    $valor = match($indice) {
                        0, 1, 2, 3 => SIMBOLOS[$indice],
                        default => str_pad($numero, 3, "0", STR_PAD_LEFT)
                    };

                    # Lógica del fondo de ajedrez: concatenamos la clase si la suma de fil+col es par
                    $clase .= (($fil + $col) % 2 == 0) ? " fondo" : "";

                    # Pintamos la celda HTML
                    echo "<td class=\"{$clase}\">{$valor}</td>\n";

                    $numero++;
                endfor;

                echo "</tr>";
            endfor;
            ?>
        </tbody>
    </table>

    <!-- NUEVO: formulario bajo el tablero -->
    <form method="post">
        <input type="hidden" name="posiciones" value="<?= implode(",", $posiciones) ?>">
        <input type="hidden" name="tieneLlave" value="<?= $tieneLlave ? 1 : 0 ?>">
        <input type="hidden" name="fin" value="<?= $fin ? 1 : 0 ?>">

        <label for="casilla">Casilla (1-100):</label>
        <input type="number" name="casilla" id="casilla" min="1" max="100" required>
        <button type="submit">Enviar</button>
    </form>

    <p><?= $mensaje ?></p>
    <p>Inventario: <?= $tieneLlave ? "🔑 Llave" : "vacío" ?></p>

</body>
</html>