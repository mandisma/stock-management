<?php

namespace App\Http\Controllers\API;

use App\Events\StockAdded;
use App\Events\StockLow;
use App\Events\StockRemoved;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddStockRequest;
use App\Http\Requests\RemoveStockRequest;
use App\Http\Resources\Product as ProductResource;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Add stock to product.
     *
     * @param AddStockRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function add(AddStockRequest $request, Product $product): ProductResource
    {
        $quantityAdded = $request->get('quantity');

        $product->increment('quantity', $quantityAdded);

        event(new StockAdded($product, $quantityAdded, $request->get('price_ht')));

        return new ProductResource($product);
    }

    /**
     * Remove stock from product.
     *
     * @param RemoveStockRequest $request
     * @param Product $product
     * @return ProductResource
     */
    public function remove(RemoveStockRequest $request, Product $product): ProductResource
    {
        $quantityRemoved = $request->get('quantity');

        $product->decrement('quantity', $quantityRemoved);

        event(new StockRemoved($product, $quantityRemoved));

        if ($product->quantity < 10) {
            event(new StockLow($product));
        }

        return new ProductResource($product);
    }
}
