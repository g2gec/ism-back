<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'chat_messages_id' => $this->chat_messages_id,
            'attachments' => $this->attachments,
            'body' => $this->body,
            'contentType' => $this->contentType,
            'createdAt' => $this->createdAt,
            'senderId' => $this->senderId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
