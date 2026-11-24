<?php
    session_start();

    if (isset($_POST['reiniciar'])) {
        session_destroy();
        session_start();
    }

    if (!isset($_SESSION['codigo'])) {
        $_SESSION['codigo'] = rand(1000, 9999);
        $_SESSION['intentos'] = 6; 
        $_SESSION['juego_terminado'] = false; 
        $_SESSION['puerta'] = 1;
    }

    $mensaje = "";
    $mensj_intento = ""; 

    if (isset($_POST['desbloquear'])){
        if ($_POST['codigo_usuario'] == $_SESSION['codigo']) {
            if ($_SESSION['puerta'] < 3) {
                $mensaje = "has abierto la puerta " . $_SESSION['puerta'] . " eres listo";
                $_SESSION['puerta']++;
                $_SESSION['codigo'] = rand(1000, 9999);
                $_SESSION['intentos'] = 6;
            } else {
                $mensaje = "has abierto las tres puertas, has escapado";
                $_SESSION['juego_terminado'] = true;
            }
        } else {
            $_SESSION['intentos']--; 
            
            if ($_SESSION['codigo'] > $_POST['codigo_usuario']) {
                $mensaje = "codigo incorrecto, el codigo es mayor";
            } else {
                $mensaje = "codigo incorrecto, el codigo es menor";
            }

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
            <label for="codigo_usuario">codigo: </label>
            <input type="number" id="codigo_usuario" name="codigo_usuario" min="1000" max="9999" required>
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
