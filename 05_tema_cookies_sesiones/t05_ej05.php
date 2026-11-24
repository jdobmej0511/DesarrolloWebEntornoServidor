<?php
session_start();

$usuarioValido = 'jose';
$passwordValida = '1234';

// cerrar sesio
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['usuario'] ?? '';
    $p = $_POST['password'] ?? '';
    if ($u === $usuarioValido && $p === $passwordValida) {
        $_SESSION['usuario'] = $u;
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    $error = 'Usuario o contraseña incorrectos';
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejercicio 5 - Login</title></head>
<body>
<?php if (isset($_SESSION['usuario'])): ?>
  <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>
  <p>Estás en la zona privada.</p>
  <a href="?logout=1">Cerrar sesión</a>
<?php else: ?>
  <h1>Acceso</h1>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>
  <form method="post">
    <p><label>Usuario: <input type="text" name="usuario" required></label></p>
    <p><label>Contraseña: <input type="password" name="password" required></label></p>
    <button type="submit">Entrar</button>
  </form>
<?php endif; ?>
</body>
</html>