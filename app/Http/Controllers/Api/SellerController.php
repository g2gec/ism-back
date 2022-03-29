<?php

namespace App\Http\Controllers\Api;

use App\AdminCustomer;
use App\Http\Controllers\Controller;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SellersRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();

        return response()->json($sellers);
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
    public function store(SellersRequest $request)
    {
        // String password
            $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ.,-(){}[]*#"), 0, 8);

        // Register
            $add = Seller::create([
                'type_seller' => $request->input('type_seller'),
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'address' => $request->input('address'),
                'document' => $request->input('document'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'discount' => $request->input('discount'),
                'advisor_permit' => $request->input('advisor_permit'),
            ]);

        if ($add->save()) {
            // Register user
                User::create([
                    //'canHire' => false,
                    'seller_id' => $add->id,
                    'name' => $request->input('name'),
                    'apellido' => $request->input('surname'),
                    'email' => $add->email,
                    //'isPublic' => true,
                    'password' => bcrypt($password),
                    'isActive' => false,
                    'lastActivity' => Carbon::now()->toDateTimeString(),
                    'role' => 'vendedor',
                    'tier' => 'VENDEDOR'
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
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Seller::find($id);

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(SellersRequest $request, Seller $seller)
    {
        $update = Seller::find($request->input('seller_id'));
        $update->type_seller = $request->input('type_seller');
        $update->name = $request->input('name');
        $update->surname = $request->input('surname');
        $update->address = $request->input('address');
        $update->document = $request->input('document');
        $update->phone = $request->input('phone');
        $update->email = $request->input('email');
        $update->discount = $request->input('discount');
        $update->advisor_permit = $request->input('advisor_permit');

        if ($update->save()) {
            // Return response
                return response()->json([201, $update]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Seller::find($id)->delete();

        return response()->json(201);
    }

    public function listCustomers($id)
    {
        $customers = AdminCustomer::whereSellerId($id)->get();

        return response()->json($customers);
    }

    public function filterCustomers(Request $request)
    {
        $seller = $request->input('seller');
        $document = $request->input('document');
        $membership = $request->input('membership');

        if ($seller != null && $document == null && $membership == null) {
            $data = AdminCustomer::whereSellerId($seller)->get();
        }
        else if ($seller != null && $document != null && $membership == null) {
            $data = AdminCustomer::where([
                        ['seller_id', $seller],
                        ['document', $document]
                    ])->get();
        }
        elseif ($seller != null && $document != null && $membership != null) {
            $data = AdminCustomer::where([
                ['seller_id', $seller],
                ['document', $document],
                ['membership_number', $membership],
            ])->get();
        }
        elseif ($seller != null && $document == null && $membership != null) {
            $data = AdminCustomer::where([
                ['seller_id', $seller],
                ['membership_number', $membership],
            ])->get();
        }
        else {
            $data = AdminCustomer::get();
        }

        return response()->json($data);
    }
}
