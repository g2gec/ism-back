<?php

namespace App\Repositories;

use App\Models\MotorMembresia;
use App\Repositories\BaseRepository;

/**
 * Class MotorMembresiaRepository
 * @package App\Repositories
 * @version May 14, 2021, 10:50 am UTC
*/

class MotorMembresiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'membresia_id',
        'motor_membresia_id',
        'descuento_motor_membresia'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MotorMembresia::class;
    }
}
