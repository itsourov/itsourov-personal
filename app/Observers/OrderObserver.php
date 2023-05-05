<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\OrderCreatedNotification;

class OrderObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;



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
        //
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