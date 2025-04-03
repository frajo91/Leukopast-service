<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hayavance=false;
        if (!empty($this->registro)) {
            $progreso=collect(json_decode(json_decode($this->registro->progreso)));
            $hayavance=true;
            $lessons=collect(json_decode(json_encode($progreso['lessons']),true));
        }

                return [
                    'IDUSUARIO' => $this->id,
                    'NOMBRE' => $this->name,
                    'APELLIDO' => $this->lastname,
                    'FARMACIA' => $this->business,
                    'CLIENTE' => $this->client,
                    'CARGO' => $this->position,
                    'CORREO' => $this->email,
                    'TELEFONO' => $this->phone,
                    'PAIS' => $this->country,
                    'CIUDAD' => $this->city,
                    'FECHA' => $this->updated_at,
                    'PORCENTAJE_CURSO' => ($hayavance) ? $progreso['p']: 0 ,
                    'PORCENTAJE_PRUEBA' => ($hayavance) ? (isset($lessons['4']['s']))?$lessons['4']['s']: 0 : 0,
                    'ESTADO_PRUEBA' => ($hayavance) ? (isset($lessons['4']['s']))?($lessons['4']['s']>=$lessons['4']['ps'])?'Aprobada':'Reprobada': 'No registra' : 'No registra',
                    'MODULOS' => ($hayavance) ? $lessons->keys()->map(function (int $item, int $key) {
                            return $item +1;
                        }): [] ,
                    'ENVIO'=>($hayavance) ? $this->registro->enviado:0,
                ];
    }

}
