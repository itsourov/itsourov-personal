<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public Post $post;
    public $featuredImageUrl;

    public $title = 'Edit Post';
    public $tabItem = 'info';

    protected function rules()
    {
        return [

            'post.title' => 'required',
            'post.slug' => 'required | unique:posts,slug,' . $this->post->id,
            'post.content' => 'required',
            'featuredImageUrl' => 'required',

        ];
    }

    public function render()
    {

        return view('livewire.admin.post-edit');
    }
    public function mount(Post $post)
    {

        $this->post = $post;


        $this->featuredImageUrl = $post->getMedia('post-thumbnails')->last()->getUrl();


    }

    public function setTab($item)
    {
        $this->tabItem = $item;
    }

    public function update()
    {

        $this->validate();
        if (!$this->post->user_id) {
            $this->post->user_id = auth()->user()->id;
        }
        $this->post->save();
        $this->post->clearMediaCollection('post-thumbnails');
        $this->post->addMediaFromUrl($this->featuredImageUrl)
            ->withResponsiveImages()
            ->toMediaCollection('post-thumbnails', 'post-thumbnails');
        // $this->product->categories()->sync($this->categoryIds);


        return redirect(route('admin.posts.index'));

    }
}