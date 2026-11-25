<?php

function conectar(): PDO
{
    static $conexion = null;

    if ($conexion === null) {
        $conexion = new PDO(
            'mysql:host=mysql;dbname=lostsignal;charset=utf8mb4',
            'alumno',
            'alumno',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    return $conexion;
}

function consultarSenales(): array
{
    $sentencia = conectar()->prepare(
        'SELECT identificador, codigo, estacion, frecuencia, intensidad, estado
         FROM senal
         ORDER BY intensidad DESC, identificador'
    );
    $sentencia->execute();

    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function consultarSenalesPorEstado(string $estado): array
{
    $sentencia = conectar()->prepare(
        'SELECT identificador, codigo, estacion, frecuencia, intensidad, estado
         FROM senal
         WHERE estado = :estado
         ORDER BY intensidad DESC, identificador'
    );
    $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);
    $sentencia->execute();

    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function consultarSenalPorIdentificador(int $identificador): array|false
{
    $sentencia = conectar()->prepare(
        'SELECT identificador, codigo, estacion, frecuencia, intensidad, estado
         FROM senal
         WHERE identificador = :identificador'
    );
    $sentencia->bindValue(':identificador', $identificador, PDO::PARAM_INT);
    $sentencia->execute();

    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function existeCodigo(string $codigo): bool
{
    $sentencia = conectar()->prepare(
        'SELECT identificador FROM senal WHERE codigo = :codigo'
    );
    $sentencia->bindValue(':codigo', $codigo, PDO::PARAM_STR);
    $sentencia->execute();

    return $sentencia->fetch(PDO::FETCH_ASSOC) !== false;
}

function insertarSenal(string $codigo, string $estacion, float $frecuencia, int $intensidad, string $estado): int
{
    $conexion = conectar();
    $sentencia = $conexion->prepare(
        'INSERT INTO senal (codigo, estacion, frecuencia, intensidad, estado)
         VALUES (:codigo, :estacion, :frecuencia, :intensidad, :estado)'
    );
    $sentencia->bindValue(':codigo', $codigo, PDO::PARAM_STR);
    $sentencia->bindValue(':estacion', $estacion, PDO::PARAM_STR);
    $sentencia->bindValue(':frecuencia', number_format($frecuencia, 3, '.', ''), PDO::PARAM_STR);
    $sentencia->bindValue(':intensidad', $intensidad, PDO::PARAM_INT);
    $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);
    $sentencia->execute();

    return (int) $conexion->lastInsertId();
}

function actualizarSenal(int $identificador, string $estacion, float $frecuencia, int $intensidad, string $estado): void
{
    $sentencia = conectar()->prepare(
        'UPDATE senal
         SET estacion = :estacion, frecuencia = :frecuencia, intensidad = :intensidad, estado = :estado
         WHERE identificador = :identificador'
    );
    $sentencia->bindValue(':estacion', $estacion, PDO::PARAM_STR);
    $sentencia->bindValue(':frecuencia', number_format($frecuencia, 3, '.', ''), PDO::PARAM_STR);
    $sentencia->bindValue(':intensidad', $intensidad, PDO::PARAM_INT);
    $sentencia->bindValue(':estado', $estado, PDO::PARAM_STR);
    $sentencia->bindValue(':identificador', $identificador, PDO::PARAM_INT);
    $sentencia->execute();
}
