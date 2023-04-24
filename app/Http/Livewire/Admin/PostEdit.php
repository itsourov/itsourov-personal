<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public Post $post;
    public $featuredImage;

    public $title = 'Edit Post';
    public $tabItem = 'info';


    protected function rules()
    {
        return [

            'post.title' => 'required',
            'post.slug' => 'required | unique:posts,slug,' . $this->post->id,
            'post.content' => 'required',

        ];
    }

    public function render()
    {

        return view('livewire.admin.post-edit');
    }
    public function mount(Post $post)
    {

        $this->post = $post;





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
        if ($this->featuredImage) {
            $validatedImage = $this->validate([
                'featuredImage' => 'image|max:1500'
            ]);

            $this->post->clearMediaCollection('post-thumbnails');
            $this->post->addMedia($validatedImage['featuredImage'])
                ->withResponsiveImages()
                ->toMediaCollection('post-thumbnails', 'post-thumbnails');
        }
        // $this->product->categories()->sync($this->categoryIds);


        return redirect(route('admin.posts.index'));

    }
}