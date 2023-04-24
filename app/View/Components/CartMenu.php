<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
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
        if (auth()->user()) {

            $cartItems = auth()->user()->cartItems->loadMissing('media')->sortByDesc('created_at');
        } else {
            $cartItems = [];
        }

        $price = 0;


        foreach ($cartItems as $cartItem) {

            $price += $cartItem->selling_price * ($cartItem->pivot->quantity ?? 1);
        }


        return view('components.cart-menu', compact('cartItems', 'price'));
    }
}