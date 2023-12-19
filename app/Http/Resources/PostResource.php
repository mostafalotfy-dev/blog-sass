<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Http;


class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "post"=>HTTP::get("https://jsonplaceholder.typicode.com/posts/{$this->id}")->json(),
            "comments"=>HTTP::get("https://jsonplaceholder.typicode.com/posts/{$this->id}/comments")->json()
        ];
    }
}
