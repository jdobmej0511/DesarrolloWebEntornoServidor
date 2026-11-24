<?php

namespace Senderismo\Modelos;

use Senderismo\Config\Database;

class Ruta
{
    public function __construct(
        public readonly int $idRuta,
        public readonly string $nombre,
        public readonly string $localidad,
        public readonly float $distancia,
        public readonly int $desnivel,
        public readonly Dificultad $dificultad
    ) {
    }

    private static function crear(array $fila): Ruta
    {
        return new Ruta(
            (int) $fila["idRuta"],
            $fila["nombre"],
            $fila["localidad"],
            (float) $fila["distancia"],
            (int) $fila["desnivel"],
            Dificultad::from($fila["dificultad"])
        );
    }

    public static function obtenerTodas(): array
    {
        $resultado = Database::conexion()->query("SELECT * FROM ruta ORDER BY nombre");
        $rutas = [];

        foreach ($resultado->fetchAll(\PDO::FETCH_ASSOC) as $fila) {
            $rutas[] = self::crear($fila);
        }

        return $rutas;
    }

    public static function obtenerPorDificultad(Dificultad $dificultad): array
    {
        $sentencia = Database::conexion()->prepare("SELECT * FROM ruta WHERE dificultad = :dificultad ORDER BY nombre");
        $sentencia->bindValue(":dificultad", $dificultad->value, \PDO::PARAM_STR);
        $sentencia->execute();
        $rutas = [];

        foreach ($sentencia->fetchAll(\PDO::FETCH_ASSOC) as $fila) {
            $rutas[] = self::crear($fila);
        }

        return $rutas;
    }

    public static function buscar(int $id): ?Ruta
    {
        $sentencia = Database::conexion()->prepare("SELECT * FROM ruta WHERE idRuta = :id");
        $sentencia->bindValue(":id", $id, \PDO::PARAM_INT);
        $sentencia->execute();
        $fila = $sentencia->fetch(\PDO::FETCH_ASSOC);

        return $fila === false ? null : self::crear($fila);
    }
}
