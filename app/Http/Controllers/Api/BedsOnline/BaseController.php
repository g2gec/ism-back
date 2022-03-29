<?php

namespace App\Http\Controllers\Api\BedsOnline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    

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
}
