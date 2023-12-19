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
            "password" => "nullable|string|min|255",
        ]);
        $user = auth("sanctum")->user();
        $input = $request->only("name", "email", "password", "file");


        if ($request->file("file")) {

            $file_name = uniqid() . "." . $input["file"]->extension();
            $input["file"]->storePubliclyAs("public/uploads/{$user->user_name}", $file_name);
            $input["file"] = $file_name;
        }
        if ($request->password) {
            $input["password"] = bcrypt($input["password"]);

        }

        $user->update($input);

        return response([
            "success" => "Updated Successfully"
        ]);
    }
}
