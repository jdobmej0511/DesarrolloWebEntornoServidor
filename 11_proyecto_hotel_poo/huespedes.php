<?php

require_once "clases/Habitacion.php";
require_once "clases/Huesped.php";
require_once "clases/Reserva.php";

session_start();

if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = [
        13 => new Habitacion(13, "Cripta Real", 120, 2),
        66 => new Habitacion(66, "Laboratorio Frankenstein", 95, 3),
        99 => new Habitacion(99, "Sarcofago Imperial", 150, 2),
        404 => new Habitacion(404, "Suite Fantasmal", 80, 1),
        666 => new Habitacion(666, "Trono de Lucifer", 110, 2),
    ];
    $_SESSION["huespedes"] = [];
    $_SESSION["reservas"] = [];
}

$error = "";
$exito = "";

if (!empty($_POST)) {
    $pila = trim($_POST["pila"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($pila === "" || $apellidos === "" || $telefono === "" || $email === "") {
        $error = "Debes rellenar todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electronico no es valido.";
    } else {
        $id = count($_SESSION["huespedes"]) + 1;
        $_SESSION["huespedes"][$id] = new Huesped($id, $pila, $apellidos, $telefono, $email);
        $exito = "Huesped registrado correctamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>huespede</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
    </style>

</head>
<body>
    <h1>Hotel terrifier</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="habitaciones.php">Habitaciones</a>
        <a href="huespedes.php">Huespedes</a>
        <a href="reservas.php">Reservas</a>
    </nav>
    <main>

<h2>Huespedes</h2>

<?php if ($error !== "") : ?>
    <p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($exito !== "") : ?>
    <p class="exito"><?php echo $exito; ?></p>
<?php endif; ?>

<form method="post">
    <label for="pila">Nombre de pila:</label>
    <input type="text" name="pila" id="pila" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" id="apellidos" required>

    <label for="telefono">Telefono:</label>
    <input type="tel" name="telefono" id="telefono" required>

    <label for="email">Correo electronico:</label>
    <input type="email" name="email" id="email" required>

    <button>Registrar</button>
</form>

<h2>Huespedes registrados</h2>

<?php if (empty($_SESSION["huespedes"])) : ?>
    <p>No hay huespedes registrados.</p>
<?php else : ?>
    <?php foreach ($_SESSION["huespedes"] as $huesped) : ?>
        <?php echo $huesped->imprimir(); ?>
    <?php endforeach; ?>
<?php endif; ?>

    </main>
</body>
</html>
