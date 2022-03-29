<?php

namespace App\Repositories;

use App\Models\ChatMessage;
use App\Repositories\BaseRepository;

/**
 * Class ChatMessageRepository
 * @package App\Repositories
 * @version May 14, 2021, 10:47 am UTC
*/

class ChatMessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'unreadCount'
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
        return ChatMessage::class;
    }
}
