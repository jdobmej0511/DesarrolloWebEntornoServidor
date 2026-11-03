<?php

class Reserva {
    public private(set) string $estado = "activa";

    public function __construct(
        public readonly int $id,
        public readonly Huesped $huesped,
        public readonly Habitacion $habitacion,
        public readonly int $noches,
    ) {
        if (!$habitacion->disponible) {
            throw new InvalidArgumentException("La habitacion no esta disponible.");
        }

        if ($noches < 1) {
            throw new InvalidArgumentException("La estancia debe ser de al menos una noche.");
        }

        $habitacion->ocupar();
    }

    public function calcularImporte(): float {
        return $this->habitacion->calcularImporte($this->noches);
    }

    public function cancelar(): void {
        if ($this->estado == "cancelada") {
            throw new InvalidArgumentException("La reserva ya esta cancelada.");
        }

        $this->estado = "cancelada";
        $this->habitacion->liberar();
    }
}