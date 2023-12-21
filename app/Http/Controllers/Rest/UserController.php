<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function update(Request $request)
    {
        $request->validate([
            "cv" => "nullable|mimetypes:application/pdf",
            "name" => "nullable|string|min:3|max:255",
            "email" => "nullable|string|email|max:255",
            "password" => "nullable|string|max:255",
            "image"=>"nullable|image|dimensions:max_width=1024,max_height=1024",
        ]);
        $user = auth("sanctum")->user();
        $input = $request->only("name", "email", "password", "file","image");


        if ($request->file("file")) {
            $file_path = public_path("uploads/{$user->user_name}/$user->file");
            if(file_exists($file_path))
            {
                unlink($file_path);
            }

            $file_name = uniqid() . "." . $input["file"]->extension();
            $input["file"]->storeAs("uploads/{$user->user_name}", $file_name);
            $input["file"] = $file_name;
        }
        if($request->file("image"))
        {
            $file_path = public_path("uploads/{$user->user_name}/$user->image");
                if(file_exists($file_path))
                {
                    unlink($file_path);
                }

            $file_name = uniqid() . "." . $input["image"]->extension();
            $input["image"]->storePubliclyAs("uploads/{$user->user_name}", $file_name);
            $input["image"] = $file_name;
        }
        if (!!$request->password) {

            $input["password"] = bcrypt($input["password"]);

        }

        $user->update($input);

        return response([
            "success" => "Updated Successfully"
        ]);
    }
}
