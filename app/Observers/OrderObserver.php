<?php

namespace App\Observers;

use Exception;
use App\Models\Order;
use App\Enums\PaymentStatus;
use App\Notifications\OrderCreatedNotification;
use App\Notifications\OrderUpdatedNotification;

class OrderObserver
{

    // /**
    //  * Handle events after all transactions are committed.
    //  *
    //  * @var bool
    //  */
    // public $afterCommit = true;



    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $order = $order->loadMissing('user');
        $order->user->notify(new OrderCreatedNotification($order));
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $order = $order->loadMissing('user');


        if ($order->payment_status == PaymentStatus::Paid) {
            $order->user->purchasedItems()->syncWithoutDetaching($order->products->pluck('id'));
        } else {
            $order->user->purchasedItems()->detach($order->products->pluck('id'));
        }
        $order->user->notify((new OrderUpdatedNotification($order))->afterCommit());

    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}