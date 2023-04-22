<?php

namespace App\Http\Livewire\Post;

use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Carbon\CarbonInterval;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class CommentSection extends Component
{
    use WithPagination;
    use WithRateLimiting;
    public Post $post;
    public $replyBoxTexts = [];
    public $commentBoxText = "";

    public $deleteCommentId;

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
        if (!auth()->user()) {
            return redirect(route('login'));
        }
        try {
            $this->rateLimit(10, 60 * 5);
        } catch (TooManyRequestsException $exception) {
            $time = CarbonInterval::seconds($exception->secondsUntilAvailable)->cascade()->forHumans();
            throw ValidationException::withMessages([

                'commentBoxText' => "Slow down! Please wait {$time}",
            ]);
        }
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
        if (!auth()->user()) {
            return redirect(route('login'));
        }
        try {
            $this->rateLimit(10, 60 * 5);
        } catch (TooManyRequestsException $exception) {
            $time = CarbonInterval::seconds($exception->secondsUntilAvailable)->cascade()->forHumans();
            throw ValidationException::withMessages([

                'replyBoxTexts.' . $parentId => "Slow down! Please wait {$time}",
            ]);
        }

        $this->validate([
            'replyBoxTexts.' . $parentId => 'required'
        ]);

        $newReply = $this->post->comments()->create([
            'user_id' => auth()->user()->id,
            'parent_id' => $parentId,
            'comment' => $this->replyBoxTexts[$parentId],
        ]);

        $this->replyBoxTexts[$parentId] = "";
        $this->dispatchBrowserEvent('scroll-to-element', ['elementId' => 'reply-' . $newReply->id]);
    }


    public function deleteCommentId($id)
    {
        $this->deleteCommentId = $id;
    }
    public function deleteComment()
    {
        $comment = Comment::findOrFail($this->deleteCommentId);
        Gate::authorize('delete', $comment);

        $comment->delete();
    }
}