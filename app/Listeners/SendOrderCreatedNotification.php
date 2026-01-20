<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $user = Admin::where('store_id', '=', $order->store_id)->first();
        $user->notifyNow(new OrderCreatedNotification($order));

        // if have more than one sender or user 
        // $users = User::where('store_id', $order->store_id)->get();
        // Notification::send($user, new OrderCreatedNotification($order)); 
        // instead of make foreach
    }
}
