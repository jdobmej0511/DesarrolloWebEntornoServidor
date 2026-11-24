<?php
session_start();

if (!empty($_POST)){
    $_SESSION["nombre"] = $_POST["nombre"] ?? "";
    $_SESSION["precio"] = $_POST["precio"] ?? 0;
    $_SESSION["noches"] = $_POST["noches"] ?? 0;
}


    function calcularEstancia($precioNoche, $numNoches): float{
        return $precioNoche * $numNoches;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Terrorifico Transilvania de las chuche</title>
    <style>
        body {
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5nUtIQReRlc5UxjW56z0zAmWjmx-PGsavKPbYvXLvUg&s=10');
        }
    </style>
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

    <h1>El HOTEL PENSILVANIA terrorificamente terrorifico</h1>

    <h2><b>Clacular estancia</b></h2>

    <form action="" method="POST">

        <div class="form-group">
            <label for="nombre">Nombre del huesped:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio por noche:</label>
            <input type="number" id="precio" name="precio" required>
        </div>

        <div class="form-group">
            <label for="noches">Numero de noches:</label>
            <input type="number" id="noches" name="noches" required>
        </div>

        <button type="submit" class="btn-submit">Calcular Importe</button>
    </form>


    <?php if (!empty($_SESSION["nombre"]) && !empty($_POST)): ?>
        <div>
            <h3>Resultado Estancia</h3>
            <p>Huesped: <?php echo $_SESSION["nombre"]; ?></p>
            <p>Precio por noche: <?php echo $_SESSION["precio"]; ?> €</p>
            <p>Numero de noches: <?php echo $_SESSION["noches"]; ?></p>
            <h5><b>Total: <?php echo calcularEstancia($_SESSION["precio"], $_SESSION["noches"]); ?> €</b></h5>
        </div>
    <?php endif; ?>

</body>
</html>
