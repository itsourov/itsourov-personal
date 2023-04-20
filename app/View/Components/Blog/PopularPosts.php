<?php

namespace App\View\Components\Blog;

use Closure;
use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PopularPosts extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $popularPosts = cache()->remember('popular-posts', 60, function () {
            return Post::take(5)->get();
        });
        return view('components.blog.popular-posts', compact('popularPosts'));
    }
}