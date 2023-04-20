<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('media')->paginate(10);
        return view('blog.index', compact('posts'));
    }
    public function show(Request $request, Post $post)
    {
        return $post->loadMissing('user.media');
    }
}