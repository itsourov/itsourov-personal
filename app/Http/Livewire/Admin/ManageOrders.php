<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ManageOrders extends Component
{
    use WithPagination;


    public function render()
    {
        $orders = Order::withCount('products')->latest()->paginate(10);
        return view('livewire.admin.manage-orders', [
            'orders' => $orders,
        ]);
    }
}