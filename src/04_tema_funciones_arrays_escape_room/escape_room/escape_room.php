<?php
    session_start();

    function generarCodigo($min, $max) {
        return rand($min, $max);
    }

    function comprobarCodigo($intento ,$codigo) {
        return $intento == $codigo;
    }

    function darPista($intento, $codigo) {
        $mensajePista = "";
        if ($codigo > $intento) {
            $mensajePista = "codigo incorrecto, el codigo es mayor";
        }
        $mensajePista =  "codigo incorrecto, el codigo es menor";

        return $mensajePista;
    }

    function iniciarPuerta() {
        if ($_SESSION['puerta'] == 1) {
            $min = 100;
            $max = 999;
            $intentos = 10;
        } elseif ($_SESSION['puerta'] == 2) {
            $min = 1000;
            $max = 9999;
            $intentos = 6;
        } else {
            $min = 10000;
            $max = 99999;
            $intentos = 4;
        }
        $_SESSION['codigo'] = generarCodigo($min, $max);
        $_SESSION['intentos'] = $intentos;
    }

    if (isset($_POST['reiniciar'])) {
        session_destroy();
        session_start();
    }

    if (!isset($_SESSION['codigo'])) {
        $_SESSION['puerta'] = 1;
        iniciarPuerta();
        $_SESSION['juego_terminado'] = false; 
    }

    $mensaje = "";
    $mensj_intento = ""; 

    if (isset($_POST['desbloquear'])){
        if (comprobarCodigo($_POST['codigo_introducio'], $_SESSION['codigo'])) {
            if ($_SESSION['puerta'] < 3) {
                $mensaje = "has abierto la puerta " . $_SESSION['puerta'] . " eres listo";
                $_SESSION['puerta']++;
                iniciarPuerta();
            } else {
                $mensaje = "has abierto las tres puertas, has escapado";
                $_SESSION['juego_terminado'] = true;
            }
        } else {
            $_SESSION['intentos']--; 
            $mensaje = darPista($_POST['codigo_introducio'], $_SESSION['codigo']);

            if ($_SESSION['intentos'] <= 0) {
                $mensaje = "has perdido tonto";
                $_SESSION['juego_terminado'] = true;
            } else {
                $mensj_intento = "intentos que te quea: " . $_SESSION['intentos'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape room</title>
</head>
<body>
    <p>codigo <?php echo $_SESSION['codigo']; ?></p>
    <p>PUERTA <?php echo $_SESSION['puerta']; ?></p>


    <?php if (isset($_SESSION['juego_terminado']) && !$_SESSION['juego_terminado']) { ?>
        <form method="POST" action="">
            <label for="codigo_introducio">codigo: </label>
            <input type="number" id="codigo_introducio" name="codigo_introducio" required>
            <button type="submit" name="desbloquear">desbloquear</button>
        </form>
    <?php } else { ?>
        <form method="POST" action="">
            <button type="submit" name="reiniciar">nueva partida</button>
        </form>
    <?php } ?>

    <?php if ($mensaje !== "") echo "<p>$mensaje</p>"; ?>
    <?php if ($mensj_intento !== "") echo "<p>$mensj_intento</p>"; ?>
</body>
</html>