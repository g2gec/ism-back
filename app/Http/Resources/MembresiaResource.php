<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MembresiaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'diseno_tarjeta' => $this->diseno_tarjeta,
            'nombre_membresia' => $this->nombre_membresia,
            'vencimiento_membresia' => $this->vencimiento_membresia,
            'precio_membresia' => $this->precio_membresia,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
