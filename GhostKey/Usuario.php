<?php

class Usuario {
    public readonly int $idUsuario;
    public readonly string $nombre;
    public readonly string $login;

    public function __construct(string $nombre = '', string $login = '') {
        $this->nombre = $nombre;

        $this->login = $login;
    }

    public static function autenticar(string $login, string $password): ?Usuario
    {
        $db = Database::obtenerInstancia();
        $sql = "SELECT idUsuario, nombre, login, password FROM usuario WHERE login = :login";
        $stament = $db->ejecutar($sql, [':login' => $login]);
        
        $usuario = $stament->fetchObject(self::class);

        if ($usuario && password_verify($password, $usuario->password)) {
            unset($usuario->password);
            return $usuario;
        }

        return null;
    }
}

?>