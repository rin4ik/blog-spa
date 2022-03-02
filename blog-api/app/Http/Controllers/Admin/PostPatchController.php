<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post; 
use Illuminate\Http\Request;

class PostPatchController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function __invoke(Request $request, Post $post)
    { 
        $request->validate([
            'title' => 'required',
            'teaser' => 'nullable',
            'body' => 'nullable',
            'published' => 'boolean',
        ]);
        $post->update($request->only('title', 'teaser', 'body', 'published'));
        return new PostResource($post);
    }
}
