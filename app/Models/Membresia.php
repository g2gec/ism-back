<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Membresia",
 *      required={"diseno_tarjeta", "nombre_membresia", "fecha_fin_membresia", "precio_membresia"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="diseno_tarjeta",
 *          description="diseno_tarjeta",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nombre_membresia",
 *          description="nombre_membresia",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fecha_fin_membresia",
 *          description="fecha_fin_membresia",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="precio_membresia",
 *          description="precio_membresia",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Membresia extends Model
{

    public $table = 'membresias';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'diseno_tarjeta',
        'nombre_membresia',
        'fecha_fin_membresia',
        'precio_membresia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'diseno_tarjeta' => 'string',
        'nombre_membresia' => 'string',
        'vencimiento_membresia' => 'datetime:Y-m-d',
        'precio_membresia' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diseno_tarjeta' => 'string',
        'nombre_membresia' => 'required|string|max:255',
        'vencimiento_membresia' => 'required',
        'precio_membresia' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
