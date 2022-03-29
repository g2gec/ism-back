<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotorMembresiaResource extends JsonResource
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
            'membresia_id' => $this->membresia_id,
            'motor_membresia_id' => $this->motor_membresia_id,
            'descuento_motor_membresia' => $this->descuento_motor_membresia,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
