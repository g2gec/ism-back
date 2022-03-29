<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use DB;


use App\Models\ChatMessage;
use App\Models\Message;
use App\Models\ParticipantMessage;
use Response;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => '/static/images/avatars/avatar_6.png',
            'canHire' => false,
            'country' => 'USA',
            'isPublic' => true,
            'phone' => '+40 777666555',
            'role' => 'asociado',
            'state' => 'New York',
            'tier' => 'ASOCIADO'
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function registerAsociado(Request $request)
    {
        if($request->data){
            $value = (object)$request->data;
        } else {
           $value = (object)$request->all();
        }

        $user = new User;
            $user->name = $value->nombre_cliente;
            $user->apellido = $value->apellido_cliente;
            $user->documento = $value->numero_identificacion_cliente;
            $user->fecha_expiracion_documento = Carbon::parse($value->fecha_expiracion)->format('Y-m-d');
            $user->costo_membresia = $value->costo_membresia;
            $user->email = $value->correo_cliente;
            $user->membresia_id = $value->tipo_membresia;
            $user->membresia_numero = $value->numero_membresia;
            $user->username = $value->nombre_cliente.".".$value->apellido_cliente;
            $user->password = Hash::make(123456789);
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            $user->isActive = false;
            $user->avatar = '/static/images/avatars/nuevoUsuario.jpg';
            $user->canHire = false;
            $user->isPublic = true;
            $user->role = 'asociado';
            $user->tier = 'ASOCIADO';
            $user->created_at = now();
            $user->updated_at = now();
        $user->save();

        return response()->json([
            'success'  => true,
            'status'  => 200
        ]);
    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);


        $changeStatus = User::find(Auth::id());
        $changeStatus->isActive = true;
        $changeStatus->lastActivity = Carbon::now()->toDateTimeString();
        $changeStatus->save();

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addHours(6);
        $token->save();

        /*$tokenResult = $changeStatus->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();*/

        $data = Auth::user();
        $data['my_seller'] = Auth::user()->customer;

        if (!is_null($token)) {
            return response()->json([
                'success'  => true,
                'user' => $data,
                'accessToken' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            ]);
        }
        else {
            return response()->json([401, "¡Credenciales erroneas!"]);
        }
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => $request->user()
        ]);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function usuarios()
    {
        $usuarios = User::all();
        return response()->json([
            'success'  => true,
            'status'  => 200,
            'usuarios' => $usuarios
        ]);
    }
}
