<?php

enum EstadoSenal: string
{
    case Pendiente = 'P';
    case Confirmada = 'C';
    case Descartada = 'D';

    public function descripcion(): string
    {
        return match ($this) {
            self::Pendiente => 'Pendiente',
            self::Confirmada => 'Confirmada',
            self::Descartada => 'Descartada',
        };
    }
}
