<?php

namespace App\Listeners;

use App\Events\StockUpdatedInterface;

class RegisterMovement
{
    /**
     * Handle the event.
     *
     * @param  StockUpdatedInterface  $event
     * @return void
     */
    public function handle(StockUpdatedInterface $event): void
    {
        $event->getProduct()->movements()->create([
            'quantity' => $event->getQuantity(),
            'price_ht' => $event->getPriceHT(),
            'action' => $event->getAction(),
        ]);
    }
}
