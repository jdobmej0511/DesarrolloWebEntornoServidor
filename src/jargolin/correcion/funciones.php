<?php

function calcularEstancia(float $precio int $noches) : float|false {
    if (($precio <= 0) || ($noches <= 0 )) return false;

    return $precio * $noches;
}
?>