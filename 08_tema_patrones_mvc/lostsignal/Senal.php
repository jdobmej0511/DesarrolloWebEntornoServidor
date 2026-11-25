<?php

require_once 'EstadoSenal.php';
require_once 'baseDatos.php';

class Senal
{
    public private(set) ?int $identificador = null;

    public readonly string $codigo;

    public string $estacion;

    public float $frecuencia {
        set {
            if ($value <= 0) {
                throw new InvalidArgumentException('La frecuencia debe ser superior a cero.');
            }
            $this->frecuencia = $value;
        }
    }

    public int $intensidad {
        set {
            if ($value < 1 || $value > 100) {
                throw new InvalidArgumentException('La intensidad debe estar comprendida entre 1 y 100.');
            }
            $this->intensidad = $value;
        }
    }

    public private(set) EstadoSenal $estado;

    public bool $prioritaria {
        get => $this->intensidad >= 80 && $this->estado === EstadoSenal::Pendiente;
    }

    public function __construct(
        string $codigo,
        string $estacion,
        float $frecuencia,
        int $intensidad,
        EstadoSenal $estado = EstadoSenal::Pendiente,
        ?int $identificador = null
    ) {
        $this->codigo = $codigo;
        $this->estacion = $estacion;
        $this->frecuencia = $frecuencia;
        $this->intensidad = $intensidad;
        $this->estado = $estado;
        $this->identificador = $identificador;
    }

    private static function hidratar(array $fila): Senal
    {
        return new Senal(
            $fila['codigo'],
            $fila['estacion'],
            (float) $fila['frecuencia'],
            (int) $fila['intensidad'],
            EstadoSenal::from($fila['estado']),
            (int) $fila['identificador']
        );
    }

    public static function obtenerTodas(): array
    {
        return array_map(self::hidratar(...), consultarSenales());
    }

    public function guardar(): void
    {
        if ($this->identificador === null) {
            $this->identificador = insertarSenal(
                $this->codigo,
                $this->estacion,
                $this->frecuencia,
                $this->intensidad,
                $this->estado->value
            );
        } else {
            actualizarSenal(
                $this->identificador,
                $this->estacion,
                $this->frecuencia,
                $this->intensidad,
                $this->estado->value
            );
        }
    }

    public static function buscar(int $identificador): ?Senal
    {
        $fila = consultarSenalPorIdentificador($identificador);

        if ($fila === false) {
            return null;
        }

        return self::hidratar($fila);
    }

    private function cambiarEstado(EstadoSenal $nuevoEstado): bool
    {
        if ($this->estado !== EstadoSenal::Pendiente) {
            return false;
        }

        $this->estado = $nuevoEstado;
        $this->guardar();

        return true;
    }

    public function confirmar(): bool
    {
        return $this->cambiarEstado(EstadoSenal::Confirmada);
    }

    public function descartar(): bool
    {
        return $this->cambiarEstado(EstadoSenal::Descartada);
    }

    public static function obtenerPorEstado(EstadoSenal $estado): array
    {
        return array_map(self::hidratar(...), consultarSenalesPorEstado($estado->value));
    }
}
