<?php

namespace App\Listeners;

use App\Events\StockLow;
use App\Models\User;
use App\Notifications\LowQuantity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendLowQuantityNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  StockLow  $event
     * @return void
     */
    public function handle(StockLow $event): void
    {
        Notification::send(User::all(), new LowQuantity($event->product));
    }
}
