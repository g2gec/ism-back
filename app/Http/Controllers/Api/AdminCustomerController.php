<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;

// Models
use App\AdminCustomer;
use App\User;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Data
            $data = AdminCustomer::with('membership')->get();

        // Return response
            return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // String password
            $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ.,-(){}[]*#"), 0, 8);

        $add = AdminCustomer::create([
            'membership_id' => $request->input('membership_id'),
            'seller_id' => $request->input('seller_id'),
            'membership_number' => $request->input('membership_number'),
            'document' => $request->input('document'),
            'duration' => $request->input('duration'),
            'cost' => $request->input('cost'),
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
            'status' => 1
        ]);

        if ($add) {
            // Create user
                User::create([
                    'avatar' => '',
                    'canHire' => false,
                    'customer_id' => $add->id,
                    'country' => 'EC',
                    'email' => $request->input('email'),
                    'apellido' => $add->name,
                    'membresia_id' => null,
                    'membresia_numero' => null,
                    'isPublic' => true,
                    'name' => $add->surname,
                    'password' => Hash::make($password),
                    //'phone' => $request->input('phone'),
                    'isActive' => false,
                    'lastActivity' => Carbon::now()->toDateTimeString(),
                    'role' => 'vendedor',
                    //'state' => $request->input('city'),
                    'domicilio' => null,
                    'documento' => null,
                    'fecha_expiracion_documento' => null,
                    'tipo_vendedor' => null,
                    'costo_membresia' => NULL,
                    'role' => 'asociado',
                    'tier' => 'ASOCIADO',
                    'email_verified_at' => now(),
                ]);

            // Data email
                $emailDetails = [
                    'title' => 'International Signature!',
                    'url'   => \Request::root(),
                    'user' => $add->name.' '.$add->surname,
                    'email' => $add->email,
                    'password' => $password
                ];

            // Send email
                Mail::send('mails.sendPassword', $emailDetails, function($message) use ($emailDetails) {
                    $message->from('testing@creatyplus.com', 'International Signature');
                    $message->to($emailDetails['email']);
                    $message->subject('Asignación de Credenciales - International Signature');
                });

            // Return response
                return response()->json([201, $add]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // search data
            $data = AdminCustomer::find($id);

        // Return
            return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $adminCustomer = AdminCustomer::find($request->input('admin_customer_id'));
        $adminCustomer->membership_id = $request->input('membership_id');
        $adminCustomer->seller_id = $request->input('seller_id');
        $adminCustomer->membership_number = $request->input('membership_number');
        $adminCustomer->document = $request->input('document');
        $adminCustomer->duration = $request->input('duration');
        $adminCustomer->cost = $request->input('cost');
        $adminCustomer->name = $request->input('name');
        $adminCustomer->surname = $request->input('surname');
        $adminCustomer->email = $request->input('email');
        if ($adminCustomer->save()) {
            $get_user = User::where('email', $adminCustomer->email)->first();
            $user = User::find($get_user->id);
            $user->customer_id = $adminCustomer->id;
            $user->save();


            // Rerturn response
                return response()->json([200, $adminCustomer]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AdminCustomer::find($id)->delete();

        return response()->json(200);
    }

    /**
     * Suspend customer
     */
    public function suspend($id)
    {
        $data = AdminCustomer::find($id);
        ($data->status == 1) ? $data->status = 2 : $data->status = 1;
        if ($data->save()) {
            return response()->json([200, $data]);
        }
    }

    /**
     * Filters
     */
    public function filters(Request $request)
    {
        // Variables
            $membership_number = $request->input('membership_number');
            $name = $request->input('name');
            $surname = $request->input('surname');
            $document = $request->input('document');
            $seller_option = $request->input('seller_option');

        // Validate variables null
            if($membership_number == null && $name == null && $surname == null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::whereNull('seller_id')->get();
                }
                else {
                    $data = AdminCustomer::get();
                }
            }
            elseif ($membership_number != null && $name == null && $surname == null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->whereMembershipNumber($membership_number)
                                ->get();
                }
                else {
                    $data = AdminCustomer::whereMembershipNumber($membership_number)->get();
                }

            }
            // Name
            elseif ($membership_number == null && $name != null && $surname == null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->whereName($name)
                                ->get();
                }
                else {
                    $data = AdminCustomer::whereName($name)->get();
                }
            }
            // Surname
            elseif ($membership_number == null && $name == null && $surname != null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->whereSurname($surname)
                                ->get();
                }
                else {
                    $data = AdminCustomer::where("surname", "=", $surname)->get();
                }
            }
            // Document
            elseif ($membership_number == null && $name == null && $surname == null && $document != null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->whereDocument($document)
                                ->get();
                }
                else {
                    $data = AdminCustomer::whereDocument($document)->get();
                }
            }
            // Name and Surname
            elseif ($membership_number == null && $name != null && $surname != null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->where([
                                    ["name", "=", $name],
                                    ["surname", "=", $surname],
                                ])
                                ->get();
                }
                else {
                    $data = AdminCustomer::where([
                        ["name", "=", $name],
                        ["surname", "=", $surname],
                    ])
                    ->get();
                }
            }
            // Search name, surname and document
            elseif ($membership_number == null && $name != null && $surname != null && $document != null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->where([
                                    ["name", "=", $name],
                                    ["surname", "=", $surname],
                                    ["document", "=", $document]
                                ])
                                ->get();
                }
                else {
                    $data = AdminCustomer::where([
                        ["name", "=", $name],
                        ["surname", "=", $surname],
                        ["document", "=", $document]
                    ])
                    ->get();
                }
            }
            // Membership and Document
            elseif ($membership_number != null && $name == null && $surname == null && $document != null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->where([
                                    ["membership_number", "=", $membership_number],
                                    ["document", "=", $document]
                                ])
                                ->get();
                }
                else {
                    $data = AdminCustomer::
                            where([
                                ["membership_number", "=", $membership_number],
                                ["document", "=", $document]
                            ])
                            ->get();
                }
            }
            // Membership, name and surname
            elseif ($membership_number != null && $name != null && $surname != null && $document == null) {
                if ($seller_option == 1) {
                    $data = AdminCustomer::
                                whereNull('seller_id')
                                ->where([
                                    ["membership_number", "=", $membership_number],
                                    ["name", "=", $name],
                                    ["surname", "=", $surname],
                                ])
                                ->get();
                }
                else {
                    $data = AdminCustomer::
                            where([
                                ["membership_number", "=", $membership_number],
                                ["name", "=", $name],
                                ["surname", "=", $surname],
                            ])
                            ->get();
                }
            }
            else {
                if ($seller_option == 1) {
                    $data = AdminCustomer::whereNull('seller_id')->get();
                }
                else {
                    $data = AdminCustomer::get();
                }
            }

            // Return response
                return response()->json($data);
    }
}
