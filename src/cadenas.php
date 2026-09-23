<?php
    $valor = 15;
    echo "El prefcio del artículoes: {$valor}€<br/>";
    echo 'El precio del artículo es: $valor <br/>';

    # Tipo Array
    $a = [6, -1, 3, 23, 8, 11] ;
    print_r($a) ;

    echo "<br/>" ;

    unset($a[5]) ;
    print_r($a) ;

    echo "<br/>" ;

    $a[] = 999 ;
    print_r($a) ;

    echo "<br/>";

    $b = ["a" => 1, "d" => 5];
    $c = ["a" => 2, 3, 6];
    $d = ["c" => 4, ...$b, ...$c];

    print_r($d);

    echo "<br/>" ;

    $resultado = "     hola, clase de dwes     " |> rtrim(...) |> strtoupper(...) ;

    echo "<pre>" . print_r($resultado, true) . "</pre>" ;

?>