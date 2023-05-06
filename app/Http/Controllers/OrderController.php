<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderActivity;
use App\Notifications\Order\OrderCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createFromCart(Request $request)
    {


        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'order_note' => '',
        ]);

        DB::beginTransaction();
        $user = auth()->user();
        $products = $user->cartItems;
        if (!$user->phone) {
            $user->update(['phone' => $validated['phone']]);
        }

        if (!count($products) > 0) {
            return back()->with('messaeg', 'Cart is empty');
        }

        $order_total = 0;
        foreach ($products as $cartItem) {

            $order_total += $cartItem->selling_price * ($cartItem->pivot->quantity ?? 1);
        }

        $newOrder = Order::create(array_merge($validated, ['order_total' => $order_total, 'user_id' => $user->id]));

        $qtys = $products->map(function ($product) use ($newOrder) {
            return ['product_id' => $product->id, 'order_id' => $newOrder->id, 'quantity' => $product->pivot->quantity];
        });
        $newOrder->products()->sync($qtys);
        $user->cartItems()->detach();

        $newOrder->activities()->create(['action_by' => 'customer', 'content' => 'Order created']);
        $user->notify(new OrderCreatedNotification($newOrder));
        DB::commit();


        return redirect(route('my-account.orders.show', $newOrder->id));
    }

    public function show(Request $request, Order $order)
    {
        // return $order->loadMissing('products');
        return view('shop.order.show');
    }
}