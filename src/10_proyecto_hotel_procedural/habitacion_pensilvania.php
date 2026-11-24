<?php
session_start();


$habitaciones = [
    ["numero" => 13, "nombre" => "Cripta real", "precio" => 120, "capacidad" => 2, "disponible" => true],
    ["numero" => 66, "nombre" => "Laboratorio Frankenstein", "precio" => 95, "capacidad" => 3, "disponible" => true],
    ["numero" => 99, "nombre" => "Sarcofago Imperial", "precio" => 150, "capacidad" => 2, "disponible" => true],
    ["numero" => 404, "nombre" => "Suite Fantasmal", "precio" => 80, "capacidad" => 1, "disponible" => true],
    ["numero" => 666, "nombre" => "Guarida del Hombre Lobo", "precio" => 110, "capacidad" => 2, "disponible" => false]
];


if (!isset($_SESSION["habitaciones"])) {
    $_SESSION["habitaciones"] = $habitaciones;
}


$habElegida = null;


if (!empty($_POST)){
    $_SESSION["nombre"] = $_POST["nombre"] ?? "";
    $_SESSION["noches"] = $_POST["noches"] ?? 0;
    $_SESSION["num_habitacion"] = $_POST["habitacion_seleccionada"] ?? 0;


    foreach ($_SESSION["habitaciones"] as $habi) {
        if ($habi["numero"] == $_SESSION["num_habitacion"]) {
            $habElegida = $habi;
            $_SESSION["precio"] = $habi["precio"];
            break;
        }
    }
}

function calcularEstancia($precioNoche, $numNoches): float{
    return $precioNoche * $numNoches;
}

function mostrarHabitaciones($habitaciones) {
    foreach ($habitaciones as $habi) {
        echo "<tr>";
        echo "<td>" . $habi["numero"] . "</td>";
        echo "<td>" . $habi["nombre"] . "</td>";
        echo "<td>" . $habi["precio"] . " €</td>";
        echo "<td>" . $habi["capacidad"] . " personas</td>";
        
        if ($habi["disponible"]) {
            echo "<td>Disponible</td>";
            echo "<td><input type='radio' name='habitacion_seleccionada' value='" . $habi["numero"] . "' required></td>";
        } else {
            echo "<td>Ocupada</td>";
            echo "<td><input type='radio' name='habitacion_seleccionada' value='" . $habi["numero"] . "' disabled></td>";
        }
        echo "</tr>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>habitaciones terrorificas</title>
</head>
<body>
    <header>
        <nav>
            <a href="hotel_pensilvania.php">Inicio</a>
            <a href="habitacion_pensilvania.php">Habitaciones</a>
            <a href="reservas_pensilvania.php">Reservas</a>
            <a href="huespedes_pensilvania.php">Huespedes</a>
            <a href="servicios_pensilvania.php">Servicios</a>
        </nav>
    </header>
    <h1>Habitaciones del terror</h1>


    <form action="" method="POST">
        <h2>Habitaciones disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Nombre</th>
                    <th>Precio / noche</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                <?php mostrarHabitaciones($_SESSION["habitaciones"]); ?>
            </tbody>
        </table>

        <h2>Calcular estancia</h2>
        <div class="form-group">
            <label for="nombre">Nombre del huesped:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="noches">Numero de noches:</label>
            <input type="number" id="noches" name="noches" required>
        </div>

        <button type="submit" class="btn-submit">Calcular Importe</button>
    </form>

    <?php if (!empty($_POST) && $habElegida != null): ?>
        <div>
            <h3>Resultado Estancia</h3>
            <p>Huesped: <?php echo $_SESSION["nombre"]; ?></p>
            <p>Habitacion: <?php echo $habElegida["nombre"]; ?> (nº <?php echo $habElegida["numero"]; ?>)</p>
            <p>Precio por noche: <?php echo $_SESSION["precio"]; ?> €</p>
            <p>Numero de noches: <?php echo $_SESSION["noches"]; ?></p>
            <h5><b>Total: <?php echo calcularEstancia($_SESSION["precio"], $_SESSION["noches"]); ?> €</b></h5>
        </div>
    <?php endif; ?>
</body>
</html>
