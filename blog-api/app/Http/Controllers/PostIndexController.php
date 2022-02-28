<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostIndexController extends Controller
{
    public function __invoke()
    {
        return PostResource::collection(Post::wherePublished(true)->get());
    }
}
