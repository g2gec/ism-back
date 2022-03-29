<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipantMessageRequest;
use App\Http\Requests\UpdateParticipantMessageRequest;
use App\Repositories\ParticipantMessageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ParticipantMessageController extends AppBaseController
{
    /** @var  ParticipantMessageRepository */
    private $participantMessageRepository;

    public function __construct(ParticipantMessageRepository $participantMessageRepo)
    {
        $this->participantMessageRepository = $participantMessageRepo;
    }

    /**
     * Display a listing of the ParticipantMessage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $participantMessages = $this->participantMessageRepository->paginate(10);

        return view('participant_messages.index')
            ->with('participantMessages', $participantMessages);
    }

    /**
     * Show the form for creating a new ParticipantMessage.
     *
     * @return Response
     */
    public function create()
    {
        return view('participant_messages.create');
    }

    /**
     * Store a newly created ParticipantMessage in storage.
     *
     * @param CreateParticipantMessageRequest $request
     *
     * @return Response
     */
    public function store(CreateParticipantMessageRequest $request)
    {
        $input = $request->all();

        $participantMessage = $this->participantMessageRepository->create($input);

        Flash::success('Participant Message saved successfully.');

        return redirect(route('participantMessages.index'));
    }

    /**
     * Display the specified ParticipantMessage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            Flash::error('Participant Message not found');

            return redirect(route('participantMessages.index'));
        }

        return view('participant_messages.show')->with('participantMessage', $participantMessage);
    }

    /**
     * Show the form for editing the specified ParticipantMessage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            Flash::error('Participant Message not found');

            return redirect(route('participantMessages.index'));
        }

        return view('participant_messages.edit')->with('participantMessage', $participantMessage);
    }

    /**
     * Update the specified ParticipantMessage in storage.
     *
     * @param int $id
     * @param UpdateParticipantMessageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParticipantMessageRequest $request)
    {
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            Flash::error('Participant Message not found');

            return redirect(route('participantMessages.index'));
        }

        $participantMessage = $this->participantMessageRepository->update($request->all(), $id);

        Flash::success('Participant Message updated successfully.');

        return redirect(route('participantMessages.index'));
    }

    /**
     * Remove the specified ParticipantMessage from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            Flash::error('Participant Message not found');

            return redirect(route('participantMessages.index'));
        }

        $this->participantMessageRepository->delete($id);

        Flash::success('Participant Message deleted successfully.');

        return redirect(route('participantMessages.index'));
    }
}
