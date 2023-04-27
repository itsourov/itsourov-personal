<?php

namespace App\Http\Livewire\Shop;


use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductReviews extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $product;
    public $newComment = [];


    protected function rules()
    {
        return [

            'newComment.comment' => 'required',

            'newComment.rating' => ['required', Rule::in([1, 2, 3, 4, 5])],


        ];
    }

    public function render()
    {

        $reviews = $this->product->reviews()->latest()->with('user')->paginate(10);
        return view('livewire.shop.product-reviews', [
            'reviews' => $reviews,
            'isPurchased' => $this->product['isPurchased'],
        ]);
    }
    public function FunctionName()
    {
        $this->dispatchBrowserEvent('scroll-to-element', ['elementId' => 'reviews']);
    }

    public function createNew()
    {
        if (!auth()->user()) {
            return redirect(route('login'));
        }
        $this->validate();
        $this->authorize('giveRating', $this->product);

        $this->product->reviews()->create(array_merge($this->newComment, ['user_id' => auth()->user()->id]));


    }
}