<?php

function conectar(): PDO
{
    try {
        return new PDO("mysql:host=db;dbname=objetos_perdidos;charset=utf8mb4", "root", "root");
    } catch (PDOException $e) {
        throw new RuntimeException("No se pudo establecer la conexión con la base de datos.");
    }
}

function buscarPorIdentificador(PDO $pdo, int $id): array|false
{
    $sentencia = $pdo->prepare("SELECT * FROM objeto WHERE idObjeto = :id");
    $sentencia->bindValue(":id", $id, PDO::PARAM_INT);
    $sentencia->execute();

    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function buscarPorTexto(PDO $pdo, string $texto): array
{
    $sentencia = $pdo->prepare("SELECT * FROM objeto WHERE nombre LIKE :nombre OR descripcion LIKE :descripcion ORDER BY fecha");
    $sentencia->bindValue(":nombre", "%$texto%", PDO::PARAM_STR);
    $sentencia->bindValue(":descripcion", "%$texto%", PDO::PARAM_STR);
    $sentencia->execute();

    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}
