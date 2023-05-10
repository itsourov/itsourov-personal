<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::public ()->latest()->search(request('search'))->with('media')->paginate(10);
        return view('blog.index', compact('posts'));
    }
    public function show(Request $request, Post $post)
    {
        // return $post->getMedia('post-thumbnails')[0]->getSrcset();
        $post = $post->loadMissing(['media', 'user.media'])->loadCount('comments');
        $post->update(['count' => $post->count + 1]);

        $SEOData = new SEOData(
            title: $post->title, image
            : $post->media->last()?->original_url,
            description: $post->content, author
            : $post->user->name,

        );

        return view('blog.show', compact('post', 'SEOData'));

    }

}