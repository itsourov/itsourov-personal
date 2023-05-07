<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;

class CartPreview extends Component
{

    protected $listeners = ['cartItemtAdeed' => 'render'];
    public function render()
    {
        if (auth()->user()) {

            $cartItems = auth()->user()->cartItems->loadMissing('media')->sortByDesc('created_at');
        } else {
            $cartItems = [];
        }

        $price = 0;


        foreach ($cartItems as $cartItem) {

            $price += $cartItem->selling_price * ($cartItem->pivot->quantity ?? 1);
        }

        return view('livewire.shop.cart-preview', compact('cartItems', 'price'));
    }
    public function removeItemFromCart($cartItem_id)
    {
        auth()->user()->cartItems()->detach($cartItem_id);
        $this->notify(__("Item was removed from cart"), 'success');
    }
}