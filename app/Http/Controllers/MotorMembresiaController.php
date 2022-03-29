<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMotorMembresiaRequest;
use App\Http\Requests\UpdateMotorMembresiaRequest;
use App\Repositories\MotorMembresiaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class MotorMembresiaController extends AppBaseController
{
    /** @var  MotorMembresiaRepository */
    private $motorMembresiaRepository;

    public function __construct(MotorMembresiaRepository $motorMembresiaRepo)
    {
        $this->motorMembresiaRepository = $motorMembresiaRepo;
    }

    /**
     * Display a listing of the MotorMembresia.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $motorMembresias = $this->motorMembresiaRepository->paginate(10);

        return view('motor_membresias.index')
            ->with('motorMembresias', $motorMembresias);
    }

    /**
     * Show the form for creating a new MotorMembresia.
     *
     * @return Response
     */
    public function create()
    {
        return view('motor_membresias.create');
    }

    /**
     * Store a newly created MotorMembresia in storage.
     *
     * @param CreateMotorMembresiaRequest $request
     *
     * @return Response
     */
    public function store(CreateMotorMembresiaRequest $request)
    {
        $input = $request->all();

        $motorMembresia = $this->motorMembresiaRepository->create($input);

        Flash::success('Motor Membresia saved successfully.');

        return redirect(route('motorMembresias.index'));
    }

    /**
     * Display the specified MotorMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            Flash::error('Motor Membresia not found');

            return redirect(route('motorMembresias.index'));
        }

        return view('motor_membresias.show')->with('motorMembresia', $motorMembresia);
    }

    /**
     * Show the form for editing the specified MotorMembresia.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            Flash::error('Motor Membresia not found');

            return redirect(route('motorMembresias.index'));
        }

        return view('motor_membresias.edit')->with('motorMembresia', $motorMembresia);
    }

    /**
     * Update the specified MotorMembresia in storage.
     *
     * @param int $id
     * @param UpdateMotorMembresiaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMotorMembresiaRequest $request)
    {
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            Flash::error('Motor Membresia not found');

            return redirect(route('motorMembresias.index'));
        }

        $motorMembresia = $this->motorMembresiaRepository->update($request->all(), $id);

        Flash::success('Motor Membresia updated successfully.');

        return redirect(route('motorMembresias.index'));
    }

    /**
     * Remove the specified MotorMembresia from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $motorMembresia = $this->motorMembresiaRepository->find($id);

        if (empty($motorMembresia)) {
            Flash::error('Motor Membresia not found');

            return redirect(route('motorMembresias.index'));
        }

        $this->motorMembresiaRepository->delete($id);

        Flash::success('Motor Membresia deleted successfully.');

        return redirect(route('motorMembresias.index'));
    }
}
