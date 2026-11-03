<?php

class Huesped {
    public string $nombre {
        get => $this->pila . " " . $this->apellidos;
        set {
            $partes = explode(" ", trim($value), 2);

            if (count($partes) < 2) {
                throw new InvalidArgumentException("Debes indicar al menos un nombre de pila y un apellido.");
            }

            [$this->pila, $this->apellidos] = $partes;
        }
    }

    public function __construct(
        public readonly int $id,
        public private(set) string $pila,
        public private(set) string $apellidos,
        public private(set) string $telefono,
        public private(set) string $email,
    ) {}

    public function imprimir(): string {
        return "<article class=\"ficha aparece\">
            <h3>Huesped {$this->id} — {$this->nombre}</h3>
            <p><strong>Nombre:</strong> {$this->nombre}</p>
            <p><strong>Telefono:</strong> {$this->telefono}</p>
            <p><strong>Correo:</strong> {$this->email}</p>
        </article>";
    }
}