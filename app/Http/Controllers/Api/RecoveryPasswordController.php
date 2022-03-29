<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

// Models
use App\AdminCustomer;
use App\User;

class RecoveryPasswordController extends Controller
{
    public function sendEmail(Request $request)
    {
        $dataUser = User::whereEmail($request->input('email'))->first();
        if (!is_null($dataUser)) {
            // Generate token
                $token = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ.,-(){}[]*#"), 0, 48);
                $dataUser->update(['token_confirmation' => $token]);


            // Send Email
                $userDetails = [
                    'title' => 'International Signature!, actualización de contraseña',
                    'user' => $dataUser->name.' '.$dataUser->apellido,
                    'email' => $dataUser->email,
                    'url'   => 'http://67.205.142.89/actualizar-clave?email='.$dataUser->email.'&token='.$token,
                ];

            //Send mail
                $path = "mails.updatePassword";

                Mail::send($path, $userDetails, function($message) use ($userDetails) {
                    $message->from('plataforma@internationalsm.com', 'International Signature');
                    $message->to($userDetails['email']);
                    $message->subject($userDetails['title']);
                });

            // Return response
                return response()->json(201);
        }
        else {
            return response()->json(400);
        }
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required',
            'token'     => 'required',
            'password'  => 'required|confirmed',
        ]);

        // Search user
            $user = User::where([
                                    ['email', '=', $request->input('email')],
                                    ['token_confirmation', '=', $request->input('token')]
                                ])
                        ->first();

            // Validate
                if (!is_null($user)) {

                    // Update password
                        $user->update([
                                        "password" => Hash::make($request->input('password')),
                                        "token_confirmation" => null
                                    ]);

                    /* Send mail */
                        $userDetails = [
                            'title' => 'International Signature!, notificación de contraseña',
                            'url'   => \Request::root(),
                            'user' => $user->name.' '.$user->apellido,
                            'email' => $user->email
                        ];

                    //Send mail
                        $path = "mails.recoveryPassword";

                        Mail::send($path, $userDetails, function($message) use ($userDetails) {
                            $message->from('plataforma@internationalsm.com', 'International Signature');
                            $message->to($userDetails['email']);
                            $message->subject($userDetails['title']);
                        });

                    // Return response
                        return response()->json([201, "¡Contraseña Actualizada!"]);

                }
                else {
                    return redirect('recovery-password')->with('error', '¡No existe el correo ingresado!');
                }
    }
}
