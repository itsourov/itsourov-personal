<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $products = $user->cartItems;
        $productCount = count($products);
        $order_total = 0;
        foreach ($products as $cartItem) {

            $order_total += $cartItem->selling_price * ($cartItem->pivot->quantity ?? 1);
        }

        return view('shop.cart', compact('products', 'order_total', 'productCount'));
    }

    public function create(Request $request, Product $product)
    {

        $oldCartItem = CartItem::where(['user_id' => auth()->user()->id, 'product_id' => $product->id])->first();
        if (!$oldCartItem) {

            auth()->user()->cartItems()->attach($product->id);

            return back()->with('cartPreview', 'Keep cartPreview open');
        } else {
            return back()->with('message', "Item already exists in cart");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        auth()->user()->cartItems()->detach($product->id);
        if (request('cartPreview')) {
            return back()->with('message', 'Item Removed from cart')->with('cartPreview', 'Keep cartPreview open');
        }
        return back()->with('message', 'Item Removed from cart');

    }
}