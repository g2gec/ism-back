<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateChatMessageAPIRequest;
use App\Http\Requests\API\UpdateChatMessageAPIRequest;
use App\Models\ChatMessage;
use App\Models\Message;
use App\Models\ParticipantMessage;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ChatMessageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ChatMessageResource;
use Response;
use DB;

/**
 * Class ChatMessageController
 * @package App\Http\Controllers\API
 */

class ChatMessageAPIController extends AppBaseController
{
    /** @var  ChatMessageRepository */
    private $chatMessageRepository;

    public function __construct(ChatMessageRepository $chatMessageRepo)
    {
        $this->chatMessageRepository = $chatMessageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/chatMessages",
     *      summary="Get a listing of the ChatMessages.",
     *      tags={"ChatMessage"},
     *      description="Get all ChatMessages",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ChatMessage")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $chatMessages = $this->chatMessageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ChatMessageResource::collection($chatMessages), 'Chat Messages retrieved successfully');
    }

    /**
     * @param CreateChatMessageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/chatMessages",
     *      summary="Store a newly created ChatMessage in storage",
     *      tags={"ChatMessage"},
     *      description="Store ChatMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ChatMessage that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ChatMessage")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ChatMessage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateChatMessageAPIRequest $request)
    {
        $input = $request->all();

        $chatMessage = $this->chatMessageRepository->create($input);

        return $this->sendResponse(new ChatMessageResource($chatMessage), 'Chat Message saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/chatMessages/{id}",
     *      summary="Display the specified ChatMessage",
     *      tags={"ChatMessage"},
     *      description="Get ChatMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ChatMessage",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ChatMessage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ChatMessage $chatMessage */
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            return $this->sendError('Chat Message not found');
        }

        return $this->sendResponse(new ChatMessageResource($chatMessage), 'Chat Message retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateChatMessageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/chatMessages/{id}",
     *      summary="Update the specified ChatMessage in storage",
     *      tags={"ChatMessage"},
     *      description="Update ChatMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ChatMessage",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ChatMessage that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ChatMessage")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ChatMessage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateChatMessageAPIRequest $request)
    {
        $input = $request->all();

        /** @var ChatMessage $chatMessage */
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            return $this->sendError('Chat Message not found');
        }

        $chatMessage = $this->chatMessageRepository->update($input, $id);

        return $this->sendResponse(new ChatMessageResource($chatMessage), 'ChatMessage updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/chatMessages/{id}",
     *      summary="Remove the specified ChatMessage from storage",
     *      tags={"ChatMessage"},
     *      description="Delete ChatMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ChatMessage",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ChatMessage $chatMessage */
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            return $this->sendError('Chat Message not found');
        }

        $chatMessage->delete();

        return $this->sendSuccess('Chat Message deleted successfully');
    }


    public function contacts()
    {
        /* $contacts = DB::table('users')->select('id', 'avatar', 'isActive', 'lastActivity', 'CONCAT(name, ' ', apellido) As name', 'username')->get(); */
        $contacts = DB::select('SELECT id, avatar, isActive, lastActivity, CONCAT(name," ", apellido) As name, username FROM users');



        return response()->json([
            'success'  => true,
            'status'  => 200,
            'contacts' => $contacts
        ]);
    }

    public function search()
    {
        $contacts = User::where('id', '!=', Auth::id())->get();

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'contacts' => $contacts,
        ]);
    }
    public function sendTxt(Request $send)
    {
        $chats = $send->all();
        $userAuth = User::find(Auth::id());

        foreach($chats['send'] as $key => $rq){
                if($rq['message_id'] === 0 ){ // mensaje nuevo
                        $chat = new ChatMessage;
                        $chat->type = $rq['type'];
                        $chat->unreadCount = $rq['unreadCount'];
                        $chat->save();
                        $chat_messages_id = $chat->id;
                } else if($rq['message_id'] !== 0 && is_numeric($rq['message_id'])) { // mensaje de grupo
                    $stract = ChatMessage::where('id', $rq['message_id'])->first();
                    $sumUnreadCount = $stract->unreadCount + 1;
                    ChatMessage::where('id', $rq['message_id'])
                        ->update(['unreadCount' => $sumUnreadCount]);
                    $chat_messages_id = $rq['message_id'];
                } else if($rq['message_id'] !== 0 && !is_numeric($rq['message_id'])) { // mensaje 1 a 1
                    $lista = ParticipantMessage::select('chat_messages_id')->where('participants_id', Auth::id())->get();
                    $lista2 = ParticipantMessage::select('chat_messages_id')->where('username', $rq['message_id'])->get();
                    foreach($lista AS $key => $list){
                        foreach($lista2 AS $key => $list2){
                            if($list['chat_messages_id'] === $list2['chat_messages_id']){
                                $chat_messages = ChatMessage::select('id')->where('type', '=', 'ONE_TO_ONE')->first();
                            }
                        }
                    }
                    $stract = ChatMessage::where('id', $chat_messages->id)->first();
                    $sumUnreadCount = $stract['unreadCount'] + 1;
                    ChatMessage::where('id', $chat_messages->id)
                        ->update(['unreadCount' => $sumUnreadCount]);
                    $chat_messages_id = $chat_messages->id;
                }

                $msj = new Message;
                $msj->chat_messages_id = $chat_messages_id;
                $msj->attachments = '';
                $msj->body = $rq['messages'];
                $msj->contentType = 'text';
                $msj->senderId = $rq['id'];
                $msj->save();

                if($rq['message_id'] === 0){ // solo si es para una sala o chat nuevo
                    $part = new ParticipantMessage;
                    $part->chat_messages_id = $chat_messages_id;
                    $part->participants_id = $userAuth->id;
                    $part->avatar = $userAuth->avatar;
                    $part->name = $userAuth->name;
                    $part->username = $userAuth->username;
                    $part->save();
                    foreach ($rq['participants'] as $key => $value) {
                        $part = new ParticipantMessage;
                        $part->chat_messages_id = $chat_messages_id;
                        $part->participants_id = $value['id'];
                        $part->avatar = $value['avatar'];
                        $part->name = $value['name'];
                        $part->username = $value['username'];
                        $part->save();
                    }
                }
        }

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'chat_messages_id' => $chat_messages_id
        ]);
    }

    public function threads()
    {
        $threads = [];
        $chats = $this->chatMessageRepository->all();
        foreach($chats as $key => $cha){
            $messages = DB::select('SELECT msj.id, msj.attachments, msj.body, msj.contentType, msj.created_at AS createdAt, msj.senderId FROM messages AS msj WHERE msj.chat_messages_id = '.$cha->id.'');
            $parti = DB::select('SELECT pm.participants_id AS id, pm.avatar, pm.name, pm.username FROM participants_messages AS pm WHERE chat_messages_id = '.$cha->id.'');
            array_push($threads, ['id'=> $cha->id, 'messages' => $messages, 'participants' => $parti, 'type' => $cha->type, 'unreadCount' => $cha->unreadCount]);
        }

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'threads' => $threads
        ]);
    }

    public function thread($id)
    {
        if (is_numeric($id)) { // si es sala grupal
            $thread = ChatMessage::find($id);
        } else if (!is_numeric($id)) { // si es sala 1 a 1
            $lista = ParticipantMessage::select('chat_messages_id')->where('username', $id)->get();
            $lista2 = ParticipantMessage::select('chat_messages_id')->where('participants_id', Auth::id())->get();
            foreach($lista as $key => $list){
                /* foreach($lista2 as $key => $list2){
                    if($list['chat_messages_id'] === $list2['chat_messages_id']){
                        $thread = ChatMessage::select('chat_messages_id')->where('type', '=', 'ONE_TO_ONE')->first();
                    }
                } */
                $lista2 = Message::select('chat_messages_id')->where('chat_messages_id', $list['chat_messages_id'])->get();
                foreach($lista2 as $key => $list2){
                    if($list['chat_messages_id'] === $list2['chat_messages_id']){
                        $thread = ChatMessage::where('type', '=', 'ONE_TO_ONE')->first();
                    }
                }
            }
        }

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'thread' => $thread
        ]);
    }

    public function visto($id)
    {
        /* $sendMsj = Message::select('senderId')->where('id', '=', $id))->first();
        if($sendMsj->senderId == Auth::id()){
            ChatMessage::where('id', $id)
                ->update(['unreadCount' => 0]);
        } */

        ChatMessage::where('id', $id)
                ->update(['unreadCount' => 0]);

        return response()->json([
            'success'  => true,
            'status'  => 200
        ]);
    }

    public function participants($id)
    {

        if (is_numeric($id)) {
            $thread = ChatMessage::find($id);
            $participants = ParticipantMessage::where('chat_messages_id', $id)->get();
        } else {
            $lista = ParticipantMessage::select('chat_messages_id')->where('username', $id)->get();
            foreach($lista as $key => $list){
                $lista2 = Message::where('chat_messages_id', $list['chat_messages_id'])->get();
                foreach($lista2 as $key => $list2){
                    if($list['chat_messages_id'] === $list2['chat_messages_id']){
                        $msj = ChatMessage::select('id')->where('type', '=', 'ONE_TO_ONE')->first();
                        $participants = ParticipantMessage::where('chat_messages_id', $msj->id)->get();
                    }
                }
            }
        }

        $parti = [];
        foreach($participants AS $key => $partici){
            $users = User::where('id', '=', $partici['participants_id'])->first();
            array_push($parti, $users);
        }

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'participants' => $parti
        ]);
    }
}
