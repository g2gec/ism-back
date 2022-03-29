<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserMessage;
use App\Message;
use App\AdminCustomer;
use App\Events\PrivateMessageEvent;
use App\Events\PrivateVideoCallEvent;

class ChatController extends Controller
{

    public function getUsers ($userId) {

        // $data = User::find($userId, ['seller_id']);
        // dd($data->seller_id);

        $users = User::with('customer')->where('id', '!=', $userId)
                     ->get();

        return response()->json([
            'data' => $users,
            'success' => true,
            'message' => 'Usuarios obtenidos con éxito'
        ]);

        foreach ($variable as $key => $value) {
            # code...
        }
    }


    public function getVendors ($userId) {

        $users = User::where('tier', '=', 'VENDEDOR')
                     ->where('id', '!=', $userId)
                     ->get();

        return response()->json([
            'data' => $users,
            'success' => true,
            'message' => 'Vendedores obtenidos con éxito'
        ]);
    }


    public function getClients ($userId) {

        $users = User::where('tier', '=', 'ASOCIADO')
                     ->where('id', '!=', $userId)
                     ->get();

        return response()->json([
            'data' => $users,
            'success' => true,
            'message' => 'Asociados obtenidos con éxito'
        ]);
    }

    public function getConversation($userId, $friendId) {


        $conversation = UserMessage::where(function($query) use($userId, $friendId) {
            $query->where('sender_id', '=', $userId)
                  ->where('receiver_id', '=', $friendId);
        })
        ->orWhere(function($query) use($userId, $friendId) {
            $query->where('sender_id', '=', $friendId)
                  ->where('receiver_id', '=', $userId);
        })->get();


        $user = User::where('id', '=', $friendId)->get();

        $data['conversation'] = $conversation;
        $data['user'] = $user[0];

        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => 'Conversación obtenida con éxito'
        ]);


    }

    public function startVideoCall(Request $request) {

        $sender_id = $request->user_id;
        $receiver_id = $request->receiver_id;
        $call_link = $request->call_link;

        $message = new UserMessage();

        $message->message = 'Video llamada iniciada 📞';
        $message->sender_id = $sender_id;
        $message->receiver_id = $receiver_id;
        // $message->parent_id = $sender_id;
        $message->type = $request->type;

        if ($message->save()) {
            try {
                $sender = User::where('id', '=', $sender_id)->first();


                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_data'] = $sender;
                $data['sender_name'] = $sender->name;
                $data['sender_surname'] = $sender->apellido;
                $data['sender_avatar'] = $sender->avatar;
                $data['receiver_id'] = $receiver_id;
                $data['message'] = $message->message;
                $data['link'] = $call_link;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;
                $data['parent_id'] = $sender_id;
                $data['type'] = $message->type;

                event(new PrivateMessageEvent($data));
                event(new PrivateVideoCallEvent($data));

                return response()->json([
                   'data' => $data,
                   'success' => true,
                    'message' => 'Call start successfully'
                ]);
            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }

}
