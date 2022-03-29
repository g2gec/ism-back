<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use File;

// Models
use App\Promotion;
use App\ServicePromotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::with('servicePromotions')->get();

        return response()->json($promotions);
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
        // Add promotion
            $add = Promotion::create([
                'title' => $request->input('title'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'description' => $request->input('description'),
                'term_conditions' => $request->input('term_conditions'),
                'valid_for' => $request->input('valid_for'),
                'total_cost' => $request->input('total_cost'),
            ]);

        // Validate
            if ($add) {
                // Add service promotions
                    foreach ($request->input('services') as $value) {
                        $array[] = json_decode($value);

                        foreach ($array as $key) {
                            ServicePromotion::create([
                                'promotion_id' => $add->id,
                                'service' => $key->service,
                                'service_discount' => $key->discount,
                                'fixed_value' => $key->fixed_value
                            ]);
                        }
                    }
                // Add file
                    $path = public_path('/uploads/promotions/'.$add->id.'/');

                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0775, true, true);
                    }

                    $fileName = $request->file->getClientOriginalName();
                    Image::make($request->file('file'))->save($path . $fileName);

                    // Register file name
                        $add->update(["url_file" => $fileName]);

                    // Return response
                        return response()->json(201);
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
        $data = Promotion::with('servicePromotions')->find($id);

        return response([201, $data]);
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
         // Update promotion
            $update = Promotion::find($request->input('promotion_id'));
            $update->title = $request->input('title');
            $update->from = $request->input('from');
            $update->to = $request->input('to');
            $update->description = $request->input('description');
            $update->term_conditions = $request->input('term_conditions');
            $update->valid_for = $request->input('valid_for');
            $update->total_cost = $request->input('total_cost');

            if ($update->save()) {
                // Edit service promotion
                    foreach ($request->input('services') as $value) {
                        $array[] = json_decode($value);

                        foreach ($array as $key) {
                            $updateSP = ServicePromotion::wherePromotionId($update->id)->first();
                            $updateSP->service = $key->service;
                            $updateSP->service_discount = $key->discount;
                            $updateSP->fixed_value = $key->fixed_value;
                            $updateSP->save();
                        }
                    }

                // Edit image
                    if ($request->hasFile('file')) {
                        $path = public_path('/uploads/promotions/'.$update->id.'/');
                        $current_file = $path.$update->file;

                        // Delete file
                            if(File::exists($current_file)){
                                File::delete($current_file);
                            }
                        // Add new file
                            $fileName = $request->file->getClientOriginalName();
                            Image::make($request->file('file'))->save($path . $fileName);

                        // Register file name
                            $update->update(["url_file" => $fileName]);
                    }
                    // Return response
                        return response()->json(201);
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
        // Search data
        $promotion = Promotion::find($id);
        $path = public_path('/uploads/promotions/'.$promotion->id.'/');

        // Delete file
            File::deleteDirectory($path);

        // Delete row
            $promotion->delete();

        // Return response
            return response()->json(201);
    }
}
