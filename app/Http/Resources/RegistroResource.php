<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hayavance = false;
        if (!empty($this->progreso)) {
            $progreso = collect(json_decode(json_decode($this->progreso)));
            $hayavance = true;
            $lessons = collect(
                json_decode(json_encode($progreso["lessons"]), true)
            );
        }
        return [
            "IDUSUARIO" => $this->usuario->id,
            "NOMBRE" => $this->usuario->name,
            "APELLIDO" => $this->usuario->lastname,
            "FARMACIA" => $this->usuario->business,
            "CLIENTE" => $this->usuario->client,
            "CARGO" => $this->usuario->position,
            "CORREO" => $this->usuario->email,
            "TELEFONO" => $this->usuario->phone,
            "PAIS" => $this->usuario->country,
            "CIUDAD" => $this->usuario->city,
            "FECHA" => $this->updated_at,
            "PORCENTAJE_CURSO" => $hayavance ? $progreso["p"] : 0,
            "PORCENTAJE_PRUEBA" => $hayavance
                ? (isset($lessons["4"]["s"])
                    ? $lessons["4"]["s"]
                    : 0)
                : 0,
            "ESTADO_PRUEBA" => $hayavance
                ? (isset($lessons["4"]["s"])
                    ? ($lessons["4"]["s"] >= $lessons["4"]["ps"]
                        ? "Aprobada"
                        : "Reprobada")
                    : "No registra")
                : "No registra",
            "MODULOS" => $hayavance
                ? $lessons->keys()->map(function (int $item, int $key) {
                    return $item + 1;
                })
                : [],
            "ENVIO" => $this->enviado,
        ];
    }
}
