<?php

namespace App\Repositories;

use App\Models\Membresia;
use App\Repositories\BaseRepository;

/**
 * Class MembresiaRepository
 * @package App\Repositories
 * @version May 14, 2021, 10:50 am UTC
*/

class MembresiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'diseno_tarjeta',
        'nombre_membresia',
        'fecha_fin_membresia',
        'precio_membresia'
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
        return Membresia::class;
    }
}
