<?php

class Database {
    private static ?Database $instancia = null;
    private PDO $conexion;

    private function __construct() {
        $host = 'mysql';
        $dbname = 'ghostkey';
        $usuario = 'alumno';
        $password = 'alumno';

        try {
            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            $this->conexion = new PDO($dsn, $usuario, $password);
            // Recomendado: activar excepciones en errores SQL
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $pdoe) {
            throw new Exception("Error, no conecta con la bd: " . $pdoe->getMessage());
        }
    }

    private function __clone() {}

    public function __wakeup() {
        throw new Exception("No se puede deserializar un Singleton.");
    }

    public static function obtenerInstancia(): Database {
        if (self::$instancia === null) {
            self::$instancia = new Database();
        }
        return self::$instancia;
    }

public function ejecutar(string $sql, array $parametros = []): \PDOStatement {

    $stament = $this->conexion->prepare($sql);


    foreach ($parametros as $clave => $valor) {
        if (is_int($clave)) {
            $nomParameto = $clave + 1;
        } else {
            $nomParameto = ':' . ltrim($clave, ':');
        }

        $tipo = match (true) {
            is_int($valor) => PDO::PARAM_INT,
            is_bool($valor) => PDO::PARAM_BOOL,
            is_null($valor) => PDO::PARAM_NULL,
            default => PDO::PARAM_STR,
        };

        $stament->bindValue($nomParameto, $valor, $tipo);
    }

    if ($stament->execute()) {
        $this->consultas++;
    }

    return $stament;
}

}
