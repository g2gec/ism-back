<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantMessageResource extends JsonResource
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
            'participants_id' => $this->participants_id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'username' => $this->username,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
