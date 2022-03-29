<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMotorMembresiaAPIRequest;
use App\Http\Requests\API\UpdateMotorMembresiaAPIRequest;
use App\Models\MotorMembresia;
use App\Repositories\MotorMembresiaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MotorMembresiaResource;
use Response;

/**
 * Class MotorMembresiaController
 * @package App\Http\Controllers\API
 */

class MotorMembresiaAPIController extends AppBaseController
{
    /** @var  MotorMembresiaRepository */
    private $motorMembresiaRepository;

    public function __construct(MotorMembresiaRepository $motorMembresiaRepo)
    {
        $this->motorMembresiaRepository = $motorMembresiaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/motorMembresias",
     *      summary="Get a listing of the MotorMembresias.",
     *      tags={"MotorMembresia"},
     *      description="Get all MotorMembresias",
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
     *                  @SWG\Items(ref="#/definitions/MotorMembresia")
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
        $motorMembresias = $this->motorMembresiaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(MotorMembresiaResource::collection($motorMembresias), 'Motor Membresias retrieved successfully');
    }

    /**
     * @param CreateMotorMembresiaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/motorMembresias",
     *      summary="Store a newly created MotorMembresia in storage",
     *      tags={"MotorMembresia"},
     *      description="Store MotorMembresia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotorMembresia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotorMembresia")
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
     *                  ref="#/definitions/MotorMembresia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMotorMembresiaAPIRequest $request)
    {
        $input = $request->all();

        $motorMembresia = $this->motorMembresiaRepository->create($input);

        return $this->sendResponse(new MotorMembresiaResource($motorMembresia), 'Motor Membresia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/motorMembresias/{id}",
     *      summary="Display the specified MotorMembresia",
     *      tags={"MotorMembresia"},
     *      description="Get MotorMembresia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotorMembresia",
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
     *                  ref="#/definitions/MotorMembresia"
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
        /** @var MotorMembresia $motorMembresia */
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            return $this->sendError('Motor Membresia not found');
        }

        return $this->sendResponse(new MotorMembresiaResource($motorMembresia), 'Motor Membresia retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMotorMembresiaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/motorMembresias/{id}",
     *      summary="Update the specified MotorMembresia in storage",
     *      tags={"MotorMembresia"},
     *      description="Update MotorMembresia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotorMembresia",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MotorMembresia that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MotorMembresia")
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
     *                  ref="#/definitions/MotorMembresia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMotorMembresiaAPIRequest $request)
    {
        $input = $request->all();

        /** @var MotorMembresia $motorMembresia */
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            return $this->sendError('Motor Membresia not found');
        }

        $motorMembresia = $this->motorMembresiaRepository->update($input, $id);

        return $this->sendResponse(new MotorMembresiaResource($motorMembresia), 'MotorMembresia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/motorMembresias/{id}",
     *      summary="Remove the specified MotorMembresia from storage",
     *      tags={"MotorMembresia"},
     *      description="Delete MotorMembresia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MotorMembresia",
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
        /** @var MotorMembresia $motorMembresia */
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            return $this->sendError('Motor Membresia not found');
        }

        $motorMembresia->delete();

        return $this->sendSuccess('Motor Membresia deleted successfully');
    }
}
