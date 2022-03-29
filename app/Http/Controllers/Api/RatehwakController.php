<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Ratehwak;
use App\Region;

class RatehwakController extends Controller
{
    public function listRegions()
    {
        $data = Region::simplePaginate(10);

        return response()->json($data);
    }

    public function filterStartRating(Request $request)
    {
	    $data = Ratehwak::
                    where('star_rating', $request->input('stars'))
                    //->orderBy('name', 'DESC')
                    ->simplePaginate(10);

        return response()->json($data);
    }

    public function homefilter(Request $request)
    {
        $paginate = 10;

        // Service type and city
        if (
            (!is_null($request->input('service_type'))) &&
            (!is_null($request->input('city')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', $request->input('service_type')],
                            ['region.name', 'like', '%' . $request->input('city') . '%']
                        ])
                        ->simplePaginate($paginate);
        }
        // Service type
        elseif (
            (!is_null($request->input('service_type'))) &&
            (is_null($request->input('city')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', $request->input('service_type')],
                            //['region.name', 'like', '%' . $request->input('city') . '%']
                        ])
                        ->simplePaginate($paginate);
        }
        // City
        elseif (
            (is_null($request->input('service_type'))) &&
            (!is_null($request->input('city')))
	    ) {
            $data = Ratehwak::
                        where([
                            //['kind', $request->input('service_type')],
                            ['region.name', 'like', '%' . $request->input('city') . '%']
                        ])
                        ->simplePaginate($paginate);
        }
        // City
        else
        {
            $data = "Ingrese parametros de busqueda.";
        }

        return response()->json([$data], 200);
    }

    public function generalFilter(Request $request)
    {
        $paginate = 10;

        // Validate received data
        if (
            (!is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
	        ($request->input('stars') != null)
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            ['name', 'like', '%' . $request->input('name') . '%'],
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country and name
        elseif (
            (!is_null($request->input('country_code'))) &&
            (!is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            ['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country
        elseif (
            (!is_null($request->input('country_code'))) &&
            (is_null($request->input('city'))) &&
            (is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            //['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By city
        elseif (
            (is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%']
                            //['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By countries and cities
        elseif (
            (!is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%']
                            //['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By cities and names
        elseif (
            (is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            ['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By name
        elseif (
            (is_null($request->input('country_code'))) &&
            (is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country and raiting stars
        elseif (
            (!is_null($request->input('country_code'))) &&
            (is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            //['name', 'like', '%' . $request->input('name') . '%']
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By cities and raiting stars
        elseif (
            (is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            //['name', 'like', '%' . $request->input('name') . '%']
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By name and raiting stars
        elseif (
            (is_null($request->input('country_code'))) &&
            (!is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['name', 'like', '%' . $request->input('name') . '%'],
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By raiting stars
        elseif (
            (is_null($request->input('country_code'))) &&
            (is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            //['name', 'like', '%' . $request->input('name') . '%'],
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country, city and name
        elseif (
            (!is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
            (is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            ['name', 'like', '%' . $request->input('name') . '%']
                            //['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country, city and stars
        elseif (
            (!is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            //['name', 'like', '%' . $request->input('name') . '%']
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By country, name and stars
        elseif (
            (!is_null($request->input('country_code'))) &&
            (is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            ['region.country_code', $request->input('country_code')],
                            //['region.name', 'like', '%' . $request->input('city') . '%'],
                            ['name', 'like', '%' . $request->input('name') . '%'],
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        // By city, name and stars
        elseif (
            (is_null($request->input('country_code'))) &&
            (!is_null($request->input('city'))) &&
            (!is_null($request->input('name'))) &&
            (!is_null($request->input('stars')))
	    ) {
            $data = Ratehwak::
                        where([
                            ['kind', "Hotel"],
                            //['region.country_code', $request->input('country_code')],
                            ['region.name', 'like', '%' . $request->input('city') . '%'],
                            ['name', 'like', '%' . $request->input('name') . '%'],
                            ['star_rating', $request->input('stars')]
                        ])
                        ->simplePaginate($paginate);
        }
        else {
            $data = "Ingrese algún parametro de busqueda.";
        }
        return response()->json([$data], 200);
    }

    public function filterById(Request $request)
    {
        $data = Ratehwak::
                        whereIn('id', $request->ids)
                        ->simplePaginate(10);

        return response()->json([$data], 200);
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

    public function payTDC (Request $request) {

        $curl = curl_init('https://api.payota.net/api/public/v1/manage/init_partners');
        curl_setopt($curl, CURLOPT_URL, 'https://api.payota.net/api/public/v1/manage/init_partners');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Content-Type: application/json",
        // "Authorization: Basic Mzc0MzowZTYzOTZjNC1kZjcxLTQ3NTctYjE1ZS02NjU1MGU5Yjg4ZDY=",
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
