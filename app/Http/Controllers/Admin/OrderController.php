<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {


        return view('admin.orders.index');
    }
    public function show(Request $request, Order $order)
    {

        $order = $order->loadMissing('products.downloadItems', 'activities');

        return view('admin.orders.show', compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'order_status' => ['required', Rule::in(OrderStatus::toArray())],
            'payment_status' => ['required', Rule::in(PaymentStatus::toArray())],
        ]);
        DB::beginTransaction();

        if ($request->order_status != $order->order_status) {
            $order->activities()->create([
                'action_by' => 'admin',
                'content' => 'Order status was changed to <b>' . $request->order_status . '</b>',
            ]);
        }
        if ($request->payment_status != $order->payment_status) {
            $order->activities()->create([
                'action_by' => 'admin',
                'content' => 'Payment status was changed to  <b>' . $request->payment_status . '</b>',
            ]);
        }


        $order->update($validated);

        if ($request->payment_status == PaymentStatus::Paid) {
            auth()->user()->purchasedItems()->syncWithoutDetaching($order->products->pluck('id'));
        } else {
            auth()->user()->purchasedItems()->detach($order->products->pluck('id'));
        }


        DB::commit();
        return back()->withNotification('Order updated');
    }
}