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
    $idHuesped = filter_var($_POST["huesped"] ?? "", FILTER_VALIDATE_INT);
    $numero = filter_var($_POST["habitacion"] ?? "", FILTER_VALIDATE_INT);
    $noches = filter_var($_POST["noches"] ?? "", FILTER_VALIDATE_INT);

    if ($idHuesped === false || !isset($_SESSION["huespedes"][$idHuesped])) {
        $error = "Debes seleccionar un huesped valido.";
    } elseif ($numero === false || !isset($_SESSION["habitaciones"][$numero])) {
        $error = "Debes seleccionar una habitacion valida.";
    } elseif ($noches === false) {
        $error = "El numero de noches debe ser un numero entero.";
    } else {
        try {
            $id = count($_SESSION["reservas"]) + 1;
            $_SESSION["reservas"][$id] = new Reserva(
                $id,
                $_SESSION["huespedes"][$idHuesped],
                $_SESSION["habitaciones"][$numero],
                $noches
            );
            $exito = "Reserva realizada correctamente.";
        } catch (InvalidArgumentException $e) {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hotel Nocturna</title>
</head>
<body>
    <h1>Hotel Nocturna</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="habitaciones.php">Habitaciones</a>
        <a href="huespedes.php">Huespedes</a>
        <a href="reservas.php">Reservas</a>
    </nav>
    <main>

<h2>Reservas</h2>

<?php if ($error !== "") : ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($exito !== "") : ?>
    <p><?php echo $exito; ?></p>
<?php endif; ?>

<h2>Nueva reserva</h2>

<?php if (empty($_SESSION["huespedes"])) : ?>
    <p>Registra primero un huesped para poder reservar.</p>
<?php else : ?>
    <form method="post">
        <label for="huesped">Huesped:</label>
        <select name="huesped" id="huesped" required>
            <?php foreach ($_SESSION["huespedes"] as $huesped) : ?>
                <option value="<?php echo $huesped->id; ?>"><?php echo $huesped->nombre; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="habitacion">Habitacion:</label>
        <select name="habitacion" id="habitacion" required>
            <?php foreach ($_SESSION["habitaciones"] as $habitacion) : ?>
                <?php if ($habitacion->disponible) : ?>
                    <option value="<?php echo $habitacion->numero; ?>"><?php echo $habitacion->nombre; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label for="noches">Noches:</label>
        <input type="number" name="noches" id="noches" min="1" value="1" required>

        <button>Reservar</button>
    </form>
<?php endif; ?>

<h2>Reservas realizadas</h2>

<?php if (empty($_SESSION["reservas"])) : ?>
    <p>No hay reservas.</p>
<?php else : ?>
    <table>
        <tr>
            <th>Reserva</th>
            <th>Huesped</th>
            <th>Habitacion</th>
            <th>Noches</th>
            <th>Importe</th>
            <th>Estado</th>
        </tr>
        <?php foreach ($_SESSION["reservas"] as $reserva) : ?>
            <tr>
                <td><?php echo $reserva->id; ?></td>
                <td><?php echo $reserva->huesped->nombre; ?></td>
                <td><?php echo $reserva->habitacion->nombre; ?></td>
                <td><?php echo $reserva->noches; ?></td>
                <td><?php echo $reserva->calcularImporte(); ?> €</td>
                <td><?php echo $reserva->estado; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

    </main>
</body>
</html>
