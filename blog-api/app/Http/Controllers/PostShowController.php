<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostShowController extends Controller
{
    public function __invoke(Post $post)
    { 
        return new PostResource($post);
    }
}
