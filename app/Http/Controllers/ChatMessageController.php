<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChatMessageRequest;
use App\Http\Requests\UpdateChatMessageRequest;
use App\Repositories\ChatMessageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ChatMessageController extends AppBaseController
{
    /** @var  ChatMessageRepository */
    private $chatMessageRepository;

    public function __construct(ChatMessageRepository $chatMessageRepo)
    {
        $this->chatMessageRepository = $chatMessageRepo;
    }

    /**
     * Display a listing of the ChatMessage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $chatMessages = $this->chatMessageRepository->paginate(10);

        return view('chat_messages.index')
            ->with('chatMessages', $chatMessages);
    }

    /**
     * Show the form for creating a new ChatMessage.
     *
     * @return Response
     */
    public function create()
    {
        return view('chat_messages.create');
    }

    /**
     * Store a newly created ChatMessage in storage.
     *
     * @param CreateChatMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateChatMessageRequest $request)
    {
        $input = $request->all();

        $chatMessage = $this->chatMessageRepository->create($input);

        Flash::success('Chat Message saved successfully.');

        return redirect(route('chatMessages.index'));
    }

    /**
     * Display the specified ChatMessage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            Flash::error('Chat Message not found');

            return redirect(route('chatMessages.index'));
        }

        return view('chat_messages.show')->with('chatMessage', $chatMessage);
    }

    /**
     * Show the form for editing the specified ChatMessage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            Flash::error('Chat Message not found');

            return redirect(route('chatMessages.index'));
        }

        return view('chat_messages.edit')->with('chatMessage', $chatMessage);
    }

    /**
     * Update the specified ChatMessage in storage.
     *
     * @param int $id
     * @param UpdateChatMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChatMessageRequest $request)
    {
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            Flash::error('Chat Message not found');

            return redirect(route('chatMessages.index'));
        }

        $chatMessage = $this->chatMessageRepository->update($request->all(), $id);

        Flash::success('Chat Message updated successfully.');

        return redirect(route('chatMessages.index'));
    }

    /**
     * Remove the specified ChatMessage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chatMessage = $this->chatMessageRepository->find($id);

        if (empty($chatMessage)) {
            Flash::error('Chat Message not found');

            return redirect(route('chatMessages.index'));
        }

        $this->chatMessageRepository->delete($id);

        Flash::success('Chat Message deleted successfully.');

        return redirect(route('chatMessages.index'));
    }
}
