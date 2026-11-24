<?php
function saludar(string $nombre): string
{
    return "Hola $nombre Bienvenidoa.";
}

echo saludar("Ana") . "<br>";
echo saludar("Luis") . "<br>";
echo saludar("Marta") . "<br>";
