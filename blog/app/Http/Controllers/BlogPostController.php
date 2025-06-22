<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogPostController extends Controller
{
    public function show($id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);

        return response()->json([
            'data' => $post
        ]);
    }
}
