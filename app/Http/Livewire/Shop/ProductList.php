<?php

namespace App\Http\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public function render()
    {
        $products = Product::latest()->with(['media', 'categories'])->withCount('reviews')->withAvg('reviews', 'rating')->paginate(12);

        return view('livewire.shop.product-list', compact('products'));
    }

    public function mount()
    {

    }
    public function addToCart($product_id)
    {

        if (!auth()->user()) {
            $this->flash(__("Please log in first"), 'warning');
            return redirect(route('login'));
        }

        $oldCartItem = CartItem::where(['user_id' => auth()->user()->id, 'product_id' => $product_id])->first();
        if (!$oldCartItem) {
            auth()->user()->cartItems()->syncWithoutDetaching($product_id);
            $this->notify(__("Product Was added to the cart"), 'success');
            $this->emit('cartItemtAdeed');
        } else {

            $this->notify(__("Item already exists in cart"), 'warning');
        }

    }
}