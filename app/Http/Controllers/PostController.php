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
        $post = $post->loadMissing(['media', 'user.media']);

        $comments = $post->comments()->with('user.media')->paginate(20);
        return view('blog.show', compact('post', 'comments'));

    }
}