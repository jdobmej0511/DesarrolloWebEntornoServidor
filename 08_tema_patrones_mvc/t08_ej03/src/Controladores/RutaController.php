<?php

namespace Senderismo\Controladores;

use Senderismo\Modelos\Dificultad;
use Senderismo\Modelos\Ruta;

class RutaController extends BaseController
{
    public function listar(): void
    {
        $valor = $_GET["dificultad"] ?? "";
        $dificultad = Dificultad::tryFrom($valor);
        $error = null;

        if ($valor !== "" && $dificultad === null) {
            $error = "La dificultad seleccionada no es válida.";
        }

        $rutas = $dificultad === null ? Ruta::obtenerTodas() : Ruta::obtenerPorDificultad($dificultad);

        $this->render("listado.html.twig", [
            "rutas" => $rutas,
            "dificultades" => Dificultad::cases(),
            "seleccionada" => $dificultad?->value ?? "",
            "error" => $error,
        ]);
    }

    public function ver(): void
    {
        $id = filter_var($_GET["id"] ?? "", FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        $ruta = $id === false ? null : Ruta::buscar($id);

        if ($ruta === null) {
            $this->error("La ruta solicitada no existe.");
            return;
        }

        $this->render("ruta.html.twig", ["ruta" => $ruta]);
    }

    public function error(string $mensaje): void
    {
        $this->render("error.html.twig", ["mensaje" => $mensaje]);
    }
}
