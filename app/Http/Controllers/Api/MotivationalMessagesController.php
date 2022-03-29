<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use File;

// Models
use App\MotivationalMessages;

class MotivationalMessagesController extends Controller
{
    public function show(Request $request)
    {
        $data = MotivationalMessages::first();
        if (!is_null($data)) {
            $path = public_path('/uploads/messages-motivationals/'.$data->id.'/'.$data->url_image);
            return response(["data" => $data, "url_image" => $path], 200);
        }
        else {
            return response(["msg" => "No existe registro asociado"], 200);
        }

    }

    public function store(Request $request)
    {
        // Add
            $add = MotivationalMessages::create([
                'user_id' => $request->input('user_id'),
                'message' => $request->input('message'),
                'status' => 1
            ]);

        // Validate
            if ($add) {
                // Add file
                    $path = public_path('/uploads/messages-motivationals/'.$add->id.'/');

                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0775, true, true);
                    }

                    $fileName = $request->file->getClientOriginalName();
                    Image::make($request->file('file'))->save($path . $fileName);

                    // Register file name
                        $add->update(["url_image" => $fileName]);

                        $image = public_path('/uploads/messages-motivationals/'.$add->id.'/'.$fileName);

                    // Return response
                        return response()->json(["data" => $add, "url_image" => $image], 200);
            }
    }

    public function update(Request $request)
    {
         // Update message
            $update = MotivationalMessages::find($request->input('id'));
            if (!is_null($update)) {
                $update->message = $request->input('message');
                $update->save();

                if ($update->save()) {
                    // Edit image
                        if ($request->hasFile('file')) {
                            $path = public_path('/uploads/messages-motivationals/'.$update->id.'/');
                            $current_file = $path.$update->url_image;

                            // Delete file
                                if(File::exists($current_file)){
                                    File::delete($current_file);
                                }
                            // Add new file
                                $fileName = $request->file->getClientOriginalName();
                                Image::make($request->file('file'))->save($path . $fileName);

                            // Register file name
                                $update->update(["url_image" => $fileName]);
                        }
                        // Return response
                            return response()->json([$update], 200);
                }
            }
            else {
                return response()->json(["data" => $update, "msg" => "No existe el registro consultado."], 404);
            }
    }

    public function updateStatus(Request $request)
    {
         // Update message
            $data = MotivationalMessages::find($request->input('id'));
            if ($data->status == 1) {
                $data->status = 2;
            }
            else {
                $data->status = 1;
            }
            $data->save();

        // Return response
            return response()->json(["data" => $data, "msg" => "Registro actualizado."], 200);

    }
}
