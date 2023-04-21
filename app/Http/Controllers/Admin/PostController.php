<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(12);
        return view('admin.posts.index', compact('posts'));
    }
    public function edit(Request $request, Post $post)
    {

        return view('admin.posts.edit', compact('post'));
    }
}