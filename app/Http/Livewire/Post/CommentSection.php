<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CommentSection extends Component
{
    use WithPagination;
    public Post $post;
    public $replyBoxTexts = [];
    public $commentBoxText = "asd";

    public function render()
    {
        $comments = $this->post->comments()->latest()->paginate(10);
        return view('livewire.post.comment-section', compact('comments'));
    }
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    protected function rules()
    {
        return [

            'commentBoxText' => 'required',


        ];
    }
    public function addComment()
    {
        $this->validate();
        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'comment' => $this->commentBoxText,
        ]);
        $this->resetPage();
        $this->commentBoxText = "";
    }
    public function addReply($parentId)
    {
        $this->validate([
            'replyBoxTexts.' . $parentId => 'required'
        ]);

        $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $parentId,
            'comment' => $this->replyBoxTexts[$parentId],
        ]);

        $this->replyBoxTexts[$parentId] = "";
    }
}