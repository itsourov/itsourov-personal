<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;

class PostEdit extends Component
{
    public Post $post;

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
    public function setTab($item)
    {
        $this->tabItem = $item;
    }

    public function update()
    {

        $this->validate();
        $this->post->save();
        // $this->product->categories()->sync($this->categoryIds);


        return redirect(route('admin.posts.index'));

    }
}