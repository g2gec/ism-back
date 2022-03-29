<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\BaseRepository;

/**
 * Class MessageRepository
 * @package App\Repositories
 * @version May 14, 2021, 10:46 am UTC
*/

class MessageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'chat_messages_id',
        'attachments',
        'body',
        'contentType',
        'createdAt',
        'senderId'
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
        return Message::class;
    }
}
