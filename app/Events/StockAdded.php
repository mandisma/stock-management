<?php

namespace App\Events;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StockAdded implements StockUpdatedInterface
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var float
     */
    protected $price_ht;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Product $product, int $quantity, float $price_ht)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->price_ht = $price_ht;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('stock-added');
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPriceHT(): ?float
    {
        return $this->price_ht;
    }

    public function getAction(): string
    {
        return ProductMovement::ACTION_ADD;
    }
}
