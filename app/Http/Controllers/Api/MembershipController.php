<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Intervention\Image\Facades\Image;

// Models
use App\Membership;

// Request
use App\Http\Requests\MembershipsRequest;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberships = Membership::all();

        return response()->json($memberships);
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
     * Register
     */
    public function register(MembershipsRequest $request)
    {
        $add = Membership::create([
            'name' => $request->input('name'),
            'expiration_date' => $request->input('expiration_date'),
            'price' => $request->input('price'),
            'motor' => $request->input('motor'),
            'discount' => $request->input('discount')
        ]);

        // Add file
            if ($add) {
                $path = public_path('/uploads/memberships/'.$add->id.'/');

                if (!File::exists($path)) {
                    File::makeDirectory($path, 0775, true, true);
                }

                $fileName = $request->file->getClientOriginalName();
                Image::make($request->file('file'))->save($path . $fileName);

                // Register file name
                    $add->update(["file" => $fileName]);

                // Return response
                    return response()->json(200);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Search data
            $membership = Membership::find($id);
            $url_file = public_path('/uploads/memberships/'.$membership->id.'/'.$membership->file);

        // Return data
            return response()->json([$membership, $url_file]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function edit(Membership $membership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Membership $membership)
    {
        // Search data
            $membership = Membership::find($request->input('membership_id'));
            // dd( $membership);
            $membership->name = $request->input('name');
            $membership->expiration_date = $request->input('expiration_date');
            $membership->price = $request->input('price');
            $membership->motor = $request->input('motor');
            $membership->discount = $request->input('discount');

            if ($membership->save()) {
                if ($request->hasFile('file')) {
                    $path = public_path('/uploads/memberships/'.$membership->id.'/');
                    $current_file = $path.$membership->file;

                    // Delete file
                        if(File::exists($current_file)){
                            File::delete($current_file);
                        }
                    // Add new file
                        $fileName = $request->file->getClientOriginalName();
                        Image::make($request->file('file'))->save($path . $fileName);

                    // Register file name
                        $membership->update(["file" => $fileName]);
                }

                // Return response
                    return response()->json(200);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Membership  $membership
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Search data
            $membership = Membership::find($id);
            $path = public_path('/uploads/memberships/'.$membership->id.'/');

            // Delete file
                File::deleteDirectory($path);

            // Delete row
                $membership->delete();

            // Return response
                return response()->json(200);
    }
}
