<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    public function __invoke()
    {
       $post = Post::create([
            'title' => 'Untitled Post'
       ]);
       return new PostResource($post);
    }
}
