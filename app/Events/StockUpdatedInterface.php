<?php

namespace App\Events;

use App\Models\Product;

interface StockUpdatedInterface
{
    /**
     * @return Product
     */
    public function getProduct(): Product;

    /**
     * @return int
     */
    public function getQuantity(): int;

    /**
     * @return float|null
     */
    public function getPriceHT(): ?float;

    /**
     * @return string
     */
    public function getAction(): string;
}
