<?php

namespace App\Http\Controllers\Api\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\UserMessage;
use App\Message;
use App\Events\PrivateMessageEvent;
use File;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public function conversation($userId) {

        $users = User::where('id', '!=', $userId)->get();
        $friendInfo = User::findOrFail($userId);
        $myInfo = User::find($userId);

        $this->data['users'] = $users;
        $this->data['friendInfo'] = $friendInfo;
        $this->data['myInfo'] = $myInfo;
        $this->data['userid'] = $userId;

        return response()->json([
            'data' => $this->data,
            'success' => true,
             'message' => 'Message sent successfully'
         ]);
    }


    public function sendMessage(Request $request) {
        

        
        // $request->validate([
        //     'message' => 'required',
        //     'receiver_id' => 'required',
        //     'user_id' => 'required'
        // ]);

        $sender_id = $request->user_id;
        $receiver_id = $request->receiver_id;
        

        $message = new UserMessage();

        $message->sender_id = $sender_id;
        $message->receiver_id = $receiver_id;
        $message->type = $request->type;

        if ($request->type === "2") {

            
            $path = public_path('/uploads/chat/files/');

            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true, true);
            }

            $fileName = uniqid(rand(), true).'.'.$request->file->getClientOriginalExtension();
            $request->file('file')->move($path, $fileName);
            $message->message = $fileName;

            // $fileName = $request->file->getClientOriginalName();
            // Image::make($request->file('file'))->save($path . $fileName);
            
        } else {
            $message->message = $request->message;
        }

        

        
        if ($message->save()) {
            try {
                $sender = User::where('id', '=', $sender_id)->first();

                
                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['sender_surname'] = $sender->apellido;
                $data['sender_avatar'] = $sender->avatar;
                $data['receiver_id'] = $receiver_id;
                $data['message'] = $message->message;
                $data['created_at'] = $message->created_at;
                $data['message_id'] = $message->id;
                $data['parent_id'] = $sender_id;
                $data['type'] = $message->type;
                
                event(new PrivateMessageEvent($data));
                
                return response()->json([
                   'data' => $data,
                   'success' => true,
                    'message' => 'Message sent successfully'
                ]);
            } catch (\Exception $e) {
                $message->delete();
            }
        }
    }
}
