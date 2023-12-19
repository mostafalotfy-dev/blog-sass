<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        return $response->json();
    }
    public function show($id)
    {
        $post = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}")->json();
        $comment = Http::get("https://jsonplaceholder.typicode.com/posts/{$id}/comments")->json();
        return response()->json(compact("post","comment"));
    }
}
