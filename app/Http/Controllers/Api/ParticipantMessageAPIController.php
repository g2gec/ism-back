<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParticipantMessageAPIRequest;
use App\Http\Requests\API\UpdateParticipantMessageAPIRequest;
use App\Models\ParticipantMessage;
use App\Repositories\ParticipantMessageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ParticipantMessageResource;
use Response;

/**
 * Class ParticipantMessageController
 * @package App\Http\Controllers\API
 */

class ParticipantMessageAPIController extends AppBaseController
{
    /** @var  ParticipantMessageRepository */
    private $participantMessageRepository;

    public function __construct(ParticipantMessageRepository $participantMessageRepo)
    {
        $this->participantMessageRepository = $participantMessageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/participantMessages",
     *      summary="Get a listing of the ParticipantMessages.",
     *      tags={"ParticipantMessage"},
     *      description="Get all ParticipantMessages",
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
     *                  @SWG\Items(ref="#/definitions/ParticipantMessage")
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
        $participantMessages = $this->participantMessageRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ParticipantMessageResource::collection($participantMessages), 'Participant Messages retrieved successfully');
    }

    /**
     * @param CreateParticipantMessageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/participantMessages",
     *      summary="Store a newly created ParticipantMessage in storage",
     *      tags={"ParticipantMessage"},
     *      description="Store ParticipantMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ParticipantMessage that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ParticipantMessage")
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
     *                  ref="#/definitions/ParticipantMessage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateParticipantMessageAPIRequest $request)
    {
        $input = $request->all();

        $participantMessage = $this->participantMessageRepository->create($input);

        return $this->sendResponse(new ParticipantMessageResource($participantMessage), 'Participant Message saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/participantMessages/{id}",
     *      summary="Display the specified ParticipantMessage",
     *      tags={"ParticipantMessage"},
     *      description="Get ParticipantMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ParticipantMessage",
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
     *                  ref="#/definitions/ParticipantMessage"
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
        /** @var ParticipantMessage $participantMessage */
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            return $this->sendError('Participant Message not found');
        }

        return $this->sendResponse(new ParticipantMessageResource($participantMessage), 'Participant Message retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateParticipantMessageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/participantMessages/{id}",
     *      summary="Update the specified ParticipantMessage in storage",
     *      tags={"ParticipantMessage"},
     *      description="Update ParticipantMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ParticipantMessage",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ParticipantMessage that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ParticipantMessage")
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
     *                  ref="#/definitions/ParticipantMessage"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateParticipantMessageAPIRequest $request)
    {
        $input = $request->all();

        /** @var ParticipantMessage $participantMessage */
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            return $this->sendError('Participant Message not found');
        }

        $participantMessage = $this->participantMessageRepository->update($input, $id);

        return $this->sendResponse(new ParticipantMessageResource($participantMessage), 'ParticipantMessage updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/participantMessages/{id}",
     *      summary="Remove the specified ParticipantMessage from storage",
     *      tags={"ParticipantMessage"},
     *      description="Delete ParticipantMessage",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ParticipantMessage",
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
        /** @var ParticipantMessage $participantMessage */
        $participantMessage = $this->participantMessageRepository->find($id);

        if (empty($participantMessage)) {
            return $this->sendError('Participant Message not found');
        }

        $participantMessage->delete();

        return $this->sendSuccess('Participant Message deleted successfully');
    }
}
