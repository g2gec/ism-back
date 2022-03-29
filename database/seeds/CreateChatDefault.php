<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreateChatDefault extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $chats = [
            [
                'type' => 'ONE_TO_ONE',
                'unreadCount' => 2
            ],
            [
                'type' => 'GROUP',
                'unreadCount' => 3
            ]
        ];

        $mensajesChats = [
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 1
            ],
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 2
            ],
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 1
            ],
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 2
            ],
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 1
            ],
            [
                'chat_messages_id' => 1,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 2
            ],
            [
                'chat_messages_id' => 2,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 1
            ],
            [
                'chat_messages_id' => 2,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 2
            ],
            [
                'chat_messages_id' => 2,
                'attachments' => '',
                'body' => 'Hey',
                'contentType' => 'text',
                'senderId' => 3
            ]
        ];

        $participantes = [
            [
                'chat_messages_id' => 1,
                'participantsChat' => 1,
                'avatar' => '/static/images/avatars/avatar_5.png',
                'name' => 'Juan Contreras',
                'username' => 'Juan.Contreras'
            ],
            [
                'chat_messages_id' => 1,
                'participantsChat' => 2,
                'avatar' => '/static/images/avatars/avatar_6.png',
                'name' => 'Katarina Smith',
                'username' => 'katarina.smith'
            ],
            [
                'chat_messages_id' => 2,
                'participantsChat' => 1,
                'avatar' => '/static/images/avatars/avatar_5.png',
                'name' => 'Juan Contreras',
                'username' => 'Juan.Contreras'
            ],
            [
                'chat_messages_id' => 2,
                'participantsChat' => 2,
                'avatar' => '/static/images/avatars/avatar_6.png',
                'name' => 'Katarina Smith',
                'username' => 'katarina.smith'
            ],
            [
                'chat_messages_id' => 2,
                'participantsChat' => 3,
                'avatar' => '/static/images/avatars/avatar_7.png',
                'name' => 'Carlos Monzalve',
                'username' => 'Carlos.Monzalve'
            ]
        ];

        foreach ($chats as $key => $value) {
            DB::table('chat_messages')->insert([
                'type' => $value['type'],
                'unreadCount' => $value['unreadCount'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach ($mensajesChats as $key => $value) {
            DB::table('messages')->insert([
                'chat_messages_id' => $value['chat_messages_id'],
                'attachments' => $value['attachments'],
                'body' => $value['body'],
                'contentType' => $value['contentType'],
                'senderId' => $value['senderId'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        foreach ($participantes as $key => $value) {
            DB::table('participants_messages')->insert([
                'chat_messages_id' => $value['chat_messages_id'],
                'participants_id' => $value['participantsChat'],
                'avatar' => $value['avatar'],
                'name' => $value['name'],
                'username' => $value['username'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}