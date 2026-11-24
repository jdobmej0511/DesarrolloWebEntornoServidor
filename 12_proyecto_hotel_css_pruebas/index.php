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

$errorHuesped = "";
$exitoHuesped = "";
$errorReserva = "";
$exitoReserva = "";

$accion = $_POST["accion"] ?? "";

if ($accion === "huesped") {
    $pila = trim($_POST["pila"] ?? "");
    $apellidos = trim($_POST["apellidos"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($pila === "" || $apellidos === "" || $telefono === "" || $email === "") {
        $errorHuesped = "Debes rellenar todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorHuesped = "El correo electronico no es valido.";
    } else {
        $id = count($_SESSION["huespedes"]) + 1;
        $_SESSION["huespedes"][$id] = new Huesped($id, $pila, $apellidos, $telefono, $email);
        $exitoHuesped = "Huesped registrado correctamente.";
    }
}

if ($accion === "reserva") {
    $idHuesped = filter_var($_POST["huesped"] ?? "", FILTER_VALIDATE_INT);
    $numero = filter_var($_POST["habitacion"] ?? "", FILTER_VALIDATE_INT);
    $noches = filter_var($_POST["noches"] ?? "", FILTER_VALIDATE_INT);

    if ($idHuesped === false || !isset($_SESSION["huespedes"][$idHuesped])) {
        $errorReserva = "Debes seleccionar un huesped valido.";
    } elseif ($numero === false || !isset($_SESSION["habitaciones"][$numero])) {
        $errorReserva = "Debes seleccionar una habitacion valida.";
    } elseif ($noches === false) {
        $errorReserva = "El numero de noches debe ser un numero entero.";
    } else {
        try {
            $id = count($_SESSION["reservas"]) + 1;
            $_SESSION["reservas"][$id] = new Reserva(
                $id,
                $_SESSION["huespedes"][$idHuesped],
                $_SESSION["habitaciones"][$numero],
                $noches
            );
            $exitoReserva = "Reserva realizada correctamente.";
        } catch (InvalidArgumentException $e) {
            $errorReserva = $e->getMessage();
        }
    }
}

$ventanas = [
    13 => [181, 300],
    66 => [316, 290],
    99 => [387, 118],
    404 => [458, 290],
    666 => [589, 330],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel del susto</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="app.js" defer></script>
</head>
<body>
    <header class="barra" id="barra">
        <a class="marca" href="#inicio">Hotel del susto</a>
        <nav aria-label="Principal">
            <a href="#inicio">Inicio</a>
            <a href="#habitaciones">Habitaciones</a>
            <a href="#huespedes">Huespedes</a>
            <a href="#reservas">Reservas</a>
        </nav>
    </header>

    <section class="noche" id="inicio">
        <div class="luna" aria-hidden="true"></div>

        <svg class="murcielagos" viewBox="0 0 300 120" aria-hidden="true">
            <path d="M40 40c6-10 14-12 22-6 2-3 4-3 6 0 8-6 16-4 22 6-7-3-13-3-17 2-3-3-6-3-8 0-3-3-7-3-9 0-4-5-10-5-16-2z"/>
            <path d="M170 18c4-7 10-8 15-4 1-2 3-2 4 0 5-4 11-3 15 4-5-2-9-2-12 1-2-2-4-2-5 0-2-2-5-2-6 0-3-3-7-3-11-1z"/>
            <path d="M226 78c5-8 11-9 17-5 2-2 3-2 5 0 6-4 12-3 17 5-6-2-10-2-14 2-2-2-4-2-6 0-2-2-5-2-7 0-3-4-7-4-12-2z"/>
        </svg>

        <div class="titular">
            <h1>Hotel del susto</h1>
            <p>Hotel terrorifico</p>
            <a class="boton boton-luz" href="#reservas">Reservar habitacion</a>
        </div>

        <svg class="castillo" viewBox="0 0 800 640" role="img" aria-label="Castillo del hotel, con una ventana por cada habitacion">
            <path class="muro" d="M150 640V230h90v410zM560 640V260h84v380zM270 640V200h260v440zM360 215V90h80v125zM60 640V470h680v170z"/>
            <path class="muro" d="M140 230l55-120 55 120zM550 260l52-110 52 110zM350 90L400 10l50 80z"/>
            <path class="muro" d="M270 182h24v20h-24zM312 182h24v20h-24zM354 182h6v20h-6zM440 182h6v20h-6zM464 182h24v20h-24zM506 182h24v20h-24zM60 452h24v20H60zM102 452h24v20h-24zM252 452h18v20h-18zM532 452h24v20h-24zM648 452h24v20h-24zM690 452h24v20h-24z"/>
            <path class="puerta" d="M366 640v-74a34 34 0 0 1 68 0v74z"/>
            <g id="ventanas">
                <?php foreach ($ventanas as $numero => $posicion) : ?>
                    <?php
                    $habitacion = $_SESSION["habitaciones"][$numero];
                    if ($habitacion->disponible) {
                        $claseVentana = "ventana encendida";
                    } else {
                        $claseVentana = "ventana";
                    }
                    ?>
                    <a class="<?php echo $claseVentana; ?>" href="#habitacion-<?php echo $numero; ?>" aria-label="Habitacion <?php echo $numero; ?>, <?php echo $habitacion->nombre; ?>">
                        <title><?php echo $habitacion->nombre; ?></title>
                        <path d="M<?php echo $posicion[0]; ?> <?php echo $posicion[1] + 52; ?>v-34a14 14 0 0 1 28 0v34z"/>
                    </a>
                <?php endforeach; ?>
            </g>
        </svg>

        <div class="niebla" aria-hidden="true"></div>

        <svg class="ola" viewBox="0 0 1600 120" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0 120V58c180-44 330-50 520-18s330 58 520 22 350-44 560-6v64z"/>
        </svg>
    </section>

    <main>
        <section class="seccion" id="habitaciones">
            <h2 class="aparece">Habitaciones</h2>
            <div id="lista-habitaciones">
                <?php foreach ($_SESSION["habitaciones"] as $habitacion) : ?>
                    <?php echo $habitacion->imprimir(); ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="seccion" id="huespedes">
            <h2 class="aparece">Huespedes</h2>
            <div class="columnas">
                <form method="post" action="#huespedes" class="panel aparece">
                    <input type="hidden" name="accion" value="huesped">

                    <label for="pila">Nombre de pila</label>
                    <input type="text" name="pila" id="pila" autocomplete="given-name" required>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" autocomplete="family-name" required>

                    <label for="telefono">Telefono</label>
                    <input type="tel" name="telefono" id="telefono" autocomplete="tel" required>

                    <label for="email">Correo electronico</label>
                    <input type="email" name="email" id="email" autocomplete="email" required>

                    <button class="boton">Registrar</button>
                </form>

                <div>
                    <div id="aviso-huesped" role="status" tabindex="-1">
                        <?php if ($errorHuesped !== "") : ?>
                            <p class="aviso error"><?php echo $errorHuesped; ?></p>
                        <?php endif; ?>
                        <?php if ($exitoHuesped !== "") : ?>
                            <p class="aviso exito"><?php echo $exitoHuesped; ?></p>
                        <?php endif; ?>
                    </div>

                    <h3 class="subtitulo">Huespedes registrados</h3>
                    <div id="lista-huespedes">
                        <?php if (empty($_SESSION["huespedes"])) : ?>
                            <p class="vacio">No hay huespedes registrados.</p>
                        <?php else : ?>
                            <?php foreach ($_SESSION["huespedes"] as $huesped) : ?>
                                <?php echo $huesped->imprimir(); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="seccion" id="reservas">
            <h2 class="aparece">Reservas</h2>
            <div class="columnas">
                <div id="zona-reserva">
                    <?php if (empty($_SESSION["huespedes"])) : ?>
                        <p class="panel vacio">Registra primero un huesped para poder reservar.</p>
                    <?php else : ?>
                        <form method="post" action="#reservas" class="panel">
                            <input type="hidden" name="accion" value="reserva">

                            <label for="huesped">Huesped</label>
                            <select name="huesped" id="huesped" required>
                                <?php foreach ($_SESSION["huespedes"] as $huesped) : ?>
                                    <option value="<?php echo $huesped->id; ?>"><?php echo $huesped->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="habitacion">Habitacion</label>
                            <select name="habitacion" id="habitacion" required>
                                <?php foreach ($_SESSION["habitaciones"] as $habitacion) : ?>
                                    <?php if ($habitacion->disponible) : ?>
                                        <option value="<?php echo $habitacion->numero; ?>"><?php echo $habitacion->nombre; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label for="noches">Noches</label>
                            <input type="number" name="noches" id="noches" min="1" value="1" required>

                            <button class="boton">Reservar</button>
                        </form>
                    <?php endif; ?>
                </div>

                <div>
                    <div id="aviso-reserva" role="status" tabindex="-1">
                        <?php if ($errorReserva !== "") : ?>
                            <p class="aviso error"><?php echo $errorReserva; ?></p>
                        <?php endif; ?>
                        <?php if ($exitoReserva !== "") : ?>
                            <p class="aviso exito"><?php echo $exitoReserva; ?></p>
                        <?php endif; ?>
                    </div>

                    <h3 class="subtitulo">Reservas realizadas</h3>
                    <div id="lista-reservas">
                        <?php if (empty($_SESSION["reservas"])) : ?>
                            <p class="vacio">No hay reservas.</p>
                        <?php else : ?>
                            <div class="tabla" tabindex="0" role="region" aria-label="Reservas realizadas">
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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="pie">
        <svg class="ola" viewBox="0 0 1600 120" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0 0v62c180 44 330 50 520 18s330-58 520-22 350 44 560 6V0z"/>
        </svg>
        <p>Hotel del susto</p>
    </footer>
</body>
</html>
