<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = auth()->user();
        $products = $user->cartItems->loadMissing('media');


        if (!count($products) > 0) {
            return redirect(route('shop.cart.index'))->withNotification('No Product found in the cart.');
        }

        $order_total = 0;
        foreach ($products as $cartItem) {

            $order_total += $cartItem->selling_price * ($cartItem->pivot->quantity ?? 1);
        }

        return view('shop.checkout', compact('user', 'products', 'order_total'));
    }
}