<?php
function procesar(int|float|string $dato): int|float
{
  if (is_string($dato)) return strlen($dato) ;
  return $dato * 2 ;
}

echo procesar(5) . "<br />" ;
echo procesar(7.5) . "<br />" ;
echo procesar("Hola mundo") . "<br />" ;
