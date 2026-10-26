<?php
function mostrarNombre(string $nombre, ?string $apellido = null): void
{
  if ($apellido === null) echo "$nombre<br />" ;
  else echo "$apellido, $nombre<br />" ;
}

mostrarNombre("Ana", "García") ;
mostrarNombre("Luis") ;
