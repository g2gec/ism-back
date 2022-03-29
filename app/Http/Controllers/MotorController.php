<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMotorRequest;
use App\Http\Requests\UpdateMotorRequest;
use App\Repositories\MotorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MotorController extends AppBaseController
{
    /** @var  MotorRepository */
    private $motorRepository;

    public function __construct(MotorRepository $motorRepo)
    {
        $this->motorRepository = $motorRepo;
    }

    /**
     * Display a listing of the Motor.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $motors = $this->motorRepository->paginate(10);

        return view('motors.index')
            ->with('motors', $motors);
    }

    /**
     * Show the form for creating a new Motor.
     *
     * @return Response
     */
    public function create()
    {
        return view('motors.create');
    }

    /**
     * Store a newly created Motor in storage.
     *
     * @param CreateMotorRequest $request
     *
     * @return Response
     */
    public function store(CreateMotorRequest $request)
    {
        $input = $request->all();

        $motor = $this->motorRepository->create($input);

        Flash::success('Motor saved successfully.');

        return redirect(route('motors.index'));
    }

    /**
     * Display the specified Motor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            Flash::error('Motor not found');

            return redirect(route('motors.index'));
        }

        return view('motors.show')->with('motor', $motor);
    }

    /**
     * Show the form for editing the specified Motor.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            Flash::error('Motor not found');

            return redirect(route('motors.index'));
        }

        return view('motors.edit')->with('motor', $motor);
    }

    /**
     * Update the specified Motor in storage.
     *
     * @param int $id
     * @param UpdateMotorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMotorRequest $request)
    {
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            Flash::error('Motor not found');

            return redirect(route('motors.index'));
        }

        $motor = $this->motorRepository->update($request->all(), $id);

        Flash::success('Motor updated successfully.');

        return redirect(route('motors.index'));
    }

    /**
     * Remove the specified Motor from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $motor = $this->motorRepository->find($id);

        if (empty($motor)) {
            Flash::error('Motor not found');

            return redirect(route('motors.index'));
        }

        $this->motorRepository->delete($id);

        Flash::success('Motor deleted successfully.');

        return redirect(route('motors.index'));
    }
}
