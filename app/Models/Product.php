<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price_ht',
    ];

    /**
     * Get the movements for the product.
     *
     * @return HasMany
     */
    public function movements(): HasMany
    {
        return $this->hasMany(ProductMovement::class);
    }
}
