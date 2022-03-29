<?php

namespace App\Http\Controllers\Api\BedsOnline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

class TestController extends Controller
{


    public function keys()
    {
        $sever = env('HOTELBEDS_SERVER');
        $apiKey = env('HOTELBEDS_APIKEY');
        $secret = env('HOTELBEDS_SECRET');
        $signature = hash( 'sha256', $apiKey.$secret.time() );



        $data = array (
            'server' => $sever,
            'signature' => $signature,  
        );

        return $data;
    }
        
}
