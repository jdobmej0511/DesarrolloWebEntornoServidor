<?php

class Habitacion {
    public function __construct(
        public readonly int $numero,
        public private(set) string $nombre,
        public float $precio {
            set {
                if ($value <= 0) {
                    throw new InvalidArgumentException("El precio por noche debe ser mayor que cero");
                }
                $this->precio = $value;
            }
        },
        public private(set) int $capacidad {
            set {
                if ($value < 1) {
                    throw new InvalidArgumentException("La capacidad debe ser de al menos una persona");
                }
                $this->capacidad = $value;
            }
        },
        public private(set) bool $disponible = true,
    ) {}

    public function ocupar(): void {
        $this->disponible = false;
    }

    public function liberar(): void {
        $this->disponible = true;
    }

    public function calcularImporte(int $noches): float {
        if ($noches < 1) {
            throw new InvalidArgumentException("La estancia debe ser de al menos una noche.");
        }

        return $this->precio * $noches;
    }

    public function imprimir(): string {
        if ($this->disponible) {
            $estado = "<p><strong>Estado:</strong> Disponible</p>";
        } else {
            $estado = "";
        }

        if ($this->capacidad == 1) {
            $textoCapacidad = "huesped";
        } else {
            $textoCapacidad = "huespedes";
        }

        return "<article>
            <h2>Habitacion {$this->numero} — {$this->nombre}</h2>
            <p><strong>Precio por noche:</strong> {$this->precio} €</p>
            <p><strong>Capacidad:</strong> {$this->capacidad} {$textoCapacidad}</p>
            {$estado}
        </article>";
    }
}