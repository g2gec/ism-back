<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMotorAPIRequest;
use App\Http\Requests\API\UpdateMotorAPIRequest;
use App\Models\Motor;
use App\Repositories\MotorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\MotorResource;
use Response;
use DB;

/**
 * Class MotorController
 * @package App\Http\Controllers\API
 */

class MotorAPIController extends AppBaseController
{
    /** @var  MotorRepository */
    private $motorRepository;

    public function __construct(MotorRepository $motorRepo)
    {
        $this->motorRepository = $motorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/motors",
     *      summary="Get a listing of the Motors.",
     *      tags={"Motor"},
     *      description="Get all Motors",
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
     *                  @SWG\Items(ref="#/definitions/Motor")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index()
    {
        $motores = DB::select('SELECT * FROM motores ORDER BY descripcion ASC');

        $mot = [];
        foreach($motores AS $key => $motor){
            array_push($mot, ['codigo' => $motor->id, 'contenido' => $motor->descripcion, 'fecha_ingreso' => $motor->created_at]);
        }

        return response()->json([
            'success'  => true,
            'status'  => 200,
            'motores' => $mot
        ]);
    }

    /**
     * @param CreateMotorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/motors",
     *      summary="Store a newly created Motor in storage",
     *      tags={"Motor"},
     *      description="Store Motor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Motor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Motor")
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
     *                  ref="#/definitions/Motor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMotorAPIRequest $request)
    {
        $input = $request->all();

        $motor = $this->motorRepository->create($input);

        return $this->sendResponse(new MotorResource($motor), 'Motor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/motors/{id}",
     *      summary="Display the specified Motor",
     *      tags={"Motor"},
     *      description="Get Motor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Motor",
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
     *                  ref="#/definitions/Motor"
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
        /** @var Motor $motor */
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            return $this->sendError('Motor not found');
        }

        return $this->sendResponse(new MotorResource($motor), 'Motor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMotorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/motors/{id}",
     *      summary="Update the specified Motor in storage",
     *      tags={"Motor"},
     *      description="Update Motor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Motor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Motor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Motor")
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
     *                  ref="#/definitions/Motor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMotorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Motor $motor */
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            return $this->sendError('Motor not found');
        }

        $motor = $this->motorRepository->update($input, $id);

        return $this->sendResponse(new MotorResource($motor), 'Motor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/motors/{id}",
     *      summary="Remove the specified Motor from storage",
     *      tags={"Motor"},
     *      description="Delete Motor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Motor",
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
        /** @var Motor $motor */
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            return $this->sendError('Motor not found');
        }

        $motor->delete();

        return $this->sendSuccess('Motor deleted successfully');
    }
}
