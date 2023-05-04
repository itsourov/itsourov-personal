<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->search(request('search'))->with('media')->paginate(10);
        return view('blog.index', compact('posts'));
    }
    public function show(Request $request, Post $post)
    {
        $post = $post->loadMissing(['media', 'user.media'])->loadCount('comments');
        $post->update(['count' => $post->count + 1]);

        return view('blog.show', compact('post'));

    }

}