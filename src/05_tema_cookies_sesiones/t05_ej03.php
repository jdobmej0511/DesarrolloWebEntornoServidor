<?php
$temas = [
    'claro'  => ['nombre' => 'Claro',  'fondo' => '#F5F7F6', 'tinta' => '#1F2933'],
    'oscuro' => ['nombre' => 'Oscuro', 'fondo' => '#1E2723', 'tinta' => '#E8F0EC'],
    'calido' => ['nombre' => 'Cálido', 'fondo' => '#FFF1DC', 'tinta' => '#653C20'],
    'frio'   => ['nombre' => 'Frío',   'fondo' => '#E8F3F8', 'tinta' => '#193AAA'],
];
$treintaDias = time() + 30 * 24 * 60 * 60;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['borrar'])) {
        setcookie('nombre', '', time() - 3600);
        setcookie('tema', '', time() - 3600);
    } else {
        $nombre = trim($_POST['nombre'] ?? '');
        $tema   = $_POST['tema'] ?? '';
        if ($nombre !== '' && isset($temas[$tema])) {
            setcookie('nombre', $nombre, $treintaDias);
            setcookie('tema', $tema, $treintaDias);
        }
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$nombre = $_COOKIE['nombre'] ?? null;
$tema   = $_COOKIE['tema'] ?? null;
$hayPrefs = $nombre !== null && isset($temas[$tema]);
$colores = $hayPrefs ? $temas[$tema] : $temas['claro'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Ejercicio 3 - Temas</title>
<style>
  body { background: <?= $colores['fondo'] ?>; color: <?= $colores['tinta'] ?>; font-family: sans-serif; padding: 2rem; }
</style>
</head>
<body>
<?php if ($hayPrefs): ?>
  <h1>ola de nuevo <?= htmlspecialchars($nombre) ?></h1>
  <p>Tema activo: <?= $colores['nombre'] ?></p>
  <form method="post">
    <button type="submit" name="borrar">Eliminar preferencias</button>
  </form>
<?php else: ?>
  <h1>Configuración inicial</h1>
  <form method="post">
    <p><label>Nombre: <input type="text" name="nombre" required></label></p>
    <p><label>Tema:
      <select name="tema">
        <?php foreach ($temas as $clave => $t): ?>
          <option value="<?= $clave ?>"><?= $t['nombre'] ?></option>
        <?php endforeach; ?>
      </select></label></p>
    <button type="submit">Guardar</button>
  </form>
<?php endif; ?>
</body>
</html>