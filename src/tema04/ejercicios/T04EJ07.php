<?php
function crearMensaje(string $nombre, string $saludo = "Hola"): string
{
  return "$saludo, $nombre" ;
}

echo crearMensaje("Ana") . "<br />" ;
echo crearMensaje("Luis", "Buenos días") . "<br />" ;
