<?php
$a = 10;
$b = 0;
try {
echo $a / $b;
} catch (DivisionByZeroError $e) {
echo 'No se puede dividir entre cero';
} finally {
echo '<br>Fin de la operación';
}
