<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactClient;
use App\Mail\ContactProvider;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

// Models
use App\AdminCustomer;
use App\User;

// Helpers
use Illuminate\Support\Facades\Hash;
use File;
use Image;

class CustomerController extends Controller
{
    /**
     * Customer register
     */
    public function register(Request $request)
    {
        $addCustomer = AdminCustomer::create([
            'customer_type' => 1,
            'name' => $request->input('first_name'),
            'surname' => $request->input('last_name'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => 1
        ]);

        // Create token
            $token = bin2hex(random_bytes(48));

        if ($addCustomer) {
            // Create user
                User::create([
                    'avatar' => '',
                    'canHire' => false,
                    'country' => 'EC',
                    'email' => $request->input('email'),
                    'apellido' => $addCustomer->surname,
                    'membresia_id' => null,
                    'membresia_numero' => null,
                    'isPublic' => true,
                    'name' => $addCustomer->name,
                    //'password' => Hash::make($request->input('email')),
                    'phone' => $request->input('phone'),
                    'isActive' => false,
                    'lastActivity' => Carbon::now()->toDateTimeString(),
                    'role' => 'vendedor',
                    'state' => $request->input('city'),
                    'domicilio' => null,
                    'documento' => null,
                    'fecha_expiracion_documento' => null,
                    'tipo_vendedor' => 'INTERNO',
                    'costo_membresia' => NULL,
                    'role' => 'asociado',
                    'tier' => 'ASOCIADO',
                    'token_confirmation' => $token,
                    'email_verified_at' => now(),
                ]);

            // Data email
                $emailDetails = [
                    'title' => 'International Signature!',
                    //'url'   => \Request::root().'/confirmar-registro',
                    'url'   => 'http://67.205.142.89/confirmar-registro?email='.$addCustomer->email.'&token='.$token,
                    'user' => $addCustomer->first_name.' '.$addCustomer->last_name,
                    'email' => $addCustomer->email
                ];

            // Send email
                Mail::send('mails.confirmRegister', $emailDetails, function($message) use ($emailDetails) {
                    $message->from('plataforma@internationalsm.com', 'International Signature');
                    $message->to($emailDetails['email']);
                    $message->subject('Confirmación de Registro - International Signature');
                });


            // Return response
            return response()->json($addCustomer);
        }
    }

    /**
     * Confirm register
     */
    public function confirmRegister(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'token'     => 'required',
            'password'  => 'required|confirmed',
        ]);

        // Search register
            $dataUser = User::where([
                                        ['email', '=', $request->input('email')],
                                        ['token_confirmation', '=', $request->input('token')]
                                    ])
                                    ->first();

        // Validate register
            if ( (!is_null($dataUser)) && !Hash::check($dataUser->password, $request->input('email'))) {
                // Register user
                    $dataUser->update(['password' => Hash::make(($request->input('password')))]);

                // Return response
                    return response()->json($dataUser, 201);
            }
            else {
                return response()->json([404, 'No existe registro de usuario.']);
            }
    }

    /**
     * Edit customer
     */
    public function editCustomer(Request $request)
    {
        $customer = User::whereId($request->input('customer_id'))->first();
        $customer->name = $request->input('first_name');
        $customer->apellido = $request->input('last_name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');
        if ($customer->save()) {
            if ($request->file('image')) {
                // Delete current image
                $file_path = '/uploads/customers/'.$customer->filename;
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }

                // Add new image
                $directory = '/uploads/customers/'.$customer->id.'/';
                $path = public_path($directory);
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                $fileName = $request->image->getClientOriginalName();
                $url = $directory . $fileName;
                Image::make($request->file('image'))->save($path . $fileName);

                $customer->update(["avatar" => $fileName, "url" => $url]);
            }

            return response()->json(["status" => "ok", "data" => $customer]);
        }
    }

    /**
     * Supplier registration
     */
    public function supplierRegistration(Request $request)
    {
        $add = Customer::create([
            'customer_type' => 2,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'type_accommodation' => $request->input('type_accomodation'),
            'accommodation_name' => $request->input('accomodation_name'),
            'accommodation_address' => $request->input('accomodation_address')
        ]);

        if ($add) {
            //Send email
            \Mail::to('krange107@gmail.com')->send(new ContactProvider($add));

            // Return response
                return response()->json($add);
        }

    }

    /**
     * Edit providers
     */
    public function editProvider(Request $request)
    {
        $provider = Customer::find($request->input('provider_id'));
        $provider->first_name = $request->input('first_name');
        $provider->last_name = $request->input('last_name');
        $provider->country = $request->input('country');
        $provider->city = $request->input('city');
        $provider->email = $request->input('email');
        $provider->phone = $request->input('phone');
        $provider->type_accommodation = $request->input('type_accomodation');
        $provider->accommodation_name = $request->input('accomodation_name');
        $provider->accommodation_address = $request->input('accomodation_address');
        if ($provider->save()) {

            if ($request->file('image')) {
                // Delete current image
                $file_path = '/uploads/providers/'.$provider->filename;
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }

                // Add new image
                $directory = '/uploads/providers/'.$provider->id.'/';
                $path = public_path($directory);
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                $fileName = $request->image->getClientOriginalName();
                $url = $directory . $fileName;
                Image::make($request->file('image'))->save($path . $fileName);

                $provider->update(["filename" => $fileName, "url" => $url]);
            }

        }
    }

    public function keys()
    {
        $sever = env('HOTELBEDS_SERVER');
        $apiKey = env('HOTELBEDS_APIKEY');
        $secret = env('HOTELBEDS_SECRET');
        $signature = hash( 'sha256', $apiKey.$secret.time() );



        $data = array (
            'server' => $sever,
            'api-key' => $apiKey,
            'signature' => $signature,
        );

        return $data;
    }

    public function get (Request $request) {

        $endpoint = $request->input('endpoint');

        $base = $this->keys();

        $url = $base['server'].$endpoint;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        'Accept:application/json',
        'Api-key:'.$base['api-key'],
        'X-Signature:'.$base['signature']

        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);

        curl_close($curl);


        return json_decode($resp, true);


    }

    public function testing (Request $request) {

        $endpoint = $request['endpoint'];

        $data = $request['data'];

        $data = json_encode($data);

        $base = $this->keys();

        $url = $base['server'].$endpoint;


        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
            'Accept:application/json',
            'Api-key:'.$base['api-key'],
            'X-Signature:'.$base['signature']

        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        // dd($headers);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);

        curl_close($curl);

        return json_decode($resp, true);

    }

    public function content (Request $request) {

        $endpoint = $request['endpoint'];

        $base = $this->keys();

        $url = $base['server'].$endpoint;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        'Accept:application/json',
        'Api-key:'.$base['api-key'],
        'X-Signature:'.$base['signature']

        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);

        curl_close($curl);

        return json_decode($resp, true);
    }

    public function ratehawk (Request $request) {

        $base_url = env('RATEHAWK_SERVER');
        $url = $base_url.$request->endpoint;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic Mzc0MzowZTYzOTZjNC1kZjcxLTQ3NTctYjE1ZS02NjU1MGU5Yjg4ZDY=",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = json_encode($request->data);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        return json_decode($resp, true);
    }
}
