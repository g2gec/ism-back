<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="MotorMembresia",
 *      required={"membresia_id", "motor_membresia_id", "descuento_motor_membresia"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="membresia_id",
 *          description="membresia_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="motor_membresia_id",
 *          description="motor_membresia_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="descuento_motor_membresia",
 *          description="descuento_motor_membresia",
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
class MotorMembresia extends Model
{

    public $table = 'motores_membresias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'membresia_id',
        'motor_membresia_id',
        'descuento_motor_membresia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'membresia_id' => 'integer',
        'motor_membresia_id' => 'integer',
        'descuento_motor_membresia' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'membresia_id' => 'required|integer',
        'motor_membresia_id' => 'required|integer',
        'descuento_motor_membresia' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
