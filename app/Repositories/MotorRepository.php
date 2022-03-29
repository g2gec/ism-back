<?php

namespace App\Repositories;

use App\Models\Motor;
use App\Repositories\BaseRepository;

/**
 * Class MotorRepository
 * @package App\Repositories
 * @version May 14, 2021, 10:50 am UTC
*/

class MotorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcion'
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
        return Motor::class;
    }
}
