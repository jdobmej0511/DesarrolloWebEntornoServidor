<?php
function saludar(string $nombre): string
{
    return "¡Hola, $nombre! Bienvenido/a.";
}

echo saludar("Ana") . "<br>";
echo saludar("Luis") . "<br>";
echo saludar("Marta") . "<br>";
