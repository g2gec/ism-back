<?php

namespace App\Repositories;

use App\Models\ParticipantMessage;
use App\Repositories\BaseRepository;

/**
 * Class ParticipantMessageRepository
 * @package App\Repositories
 * @version May 14, 2021, 5:13 pm UTC
*/

class ParticipantMessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'chat_messages_id',
        'participants_id',
        'avatar',
        'name',
        'username'
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
        return ParticipantMessage::class;
    }
}
