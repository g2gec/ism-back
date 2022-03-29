<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Message",
 *      required={"chat_messages_id", "body", "contentType", "createdAt", "senderId"},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="chat_messages_id",
 *          description="chat_messages_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="attachments",
 *          description="attachments",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="body",
 *          description="body",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="contentType",
 *          description="contentType",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="createdAt",
 *          description="createdAt",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="senderId",
 *          description="senderId",
 *          type="integer",
 *          format="int32"
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
class Message extends Model
{

    public $table = 'messages';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'chat_messages_id',
        'attachments',
        'body',
        'contentType',
        'createdAt',
        'senderId'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'chat_messages_id' => 'string',
        'attachments' => 'string',
        'body' => 'string',
        'contentType' => 'string',
        'createdAt' => 'datetime',
        'senderId' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'chat_messages_id' => 'string',
        'attachments' => 'string',
        'body' => 'string',
        'contentType' => 'string|max:255',
        'senderId' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];
}
