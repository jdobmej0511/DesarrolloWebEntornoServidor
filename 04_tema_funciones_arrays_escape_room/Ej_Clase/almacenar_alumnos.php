<?php
# Almacena convenientemente la siguiente lista de alumnos y notas:
#
# Laura   : 8.5
# Pedro   : 4.0
# Marta   : 6.5
# Sergio  : 3.0
# Carlos  : 5.0
# Elena   : 0.2
# David   : 9.2
# Ana     : 7.0
# Pablo   : 4.8
# Lucía   : 10

#
# APARTADO 1:
# Crea una constante NOTA_CORTE = 5.0
# Utiliza array_filter con un cierre que permita obtener un nuevo array con únicamente los
# alumnos que superen la nota de corte. PISTA: investiga la instrucción use.
#
# APARTADO 2:
# Crea una constante PUNTOS_EXTRA = 1.0
# Aplica un array_map sobre el array origial con una función anónima que devuelva un nuevo
# array donde la nota de cada alumno tenga sumada esa bonificación.
#
# APARTADO 3:
# Utiliza array_reduce con una función anónima para calcular la suma total de todas las notas
# de la lista original de alumnos.
#
# APARTADO 4:
# Crea una función llamada contarSegunCriterio que reciba dos parámetros: la lista de alumnos
# original y una función anónima o callable.
# La función contarSegunCriterio deberá aplicar la función a cada alumno y devolver cuántos
# cumplen la condición impuesta en el cierre.
#
# Comprueba las siguientes condiciones:
#
# a. Alumnos con nota sobresaliente (>=9)
# b. Alumnos en estado crítico (< 4)
# c. Alumnos con un nombre con más de 4 caracteres
# d. Alumnos cuyo nombre empiece con P. 



$alumnos = [
    'Laura'  => 8.5,
    'Pedro'  => 4.0,
    'Marta'  => 6.5,
    'Sergio' => 3.0,
    'Carlos' => 5.0,
    'Elena'  => 0.2,
    'David'  => 9.2,
    'Ana'    => 7.0,
    'Pablo'  => 4.8,
    'Lucía'  => 10.0,
];

$nota_corte = 5.0;

const PUNTOS_EXTRA = 1.0;


$aprobado = array_filter($alumnos, function($nota) use ($nota_corte) {
    return $nota >= $nota_corte;
});

echo "Aprobados:<br/>";
print_r($aprobado);

$notaExtra = array_map(function($nota){
    return $nota + PUNTOS_EXTRA;
}, $alumnos);

echo "<br/><br/>Nota extra:<br/>";
print_r($notaExtra);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacenar Alumnos</title>
</head>
<body>
    
</body>
</html>