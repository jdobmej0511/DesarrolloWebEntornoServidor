<?php
$ultima = $_COOKIE['ultima_visita'] ?? null;


setcookie('ultima_visita', date('d/m/Y H:i:s'), time() + 365 * 24 * 60 * 60);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejercicio 4 - Última visita</title></head>
<body>
<?php if ($ultima === null): ?>
    <h1>Esta es tu primera visita</h1>
<?php else: ?>
    <h1>Tu última visita fue el <?= htmlspecialchars($ultima) ?></h1>
<?php endif; ?>
</body>
</html>