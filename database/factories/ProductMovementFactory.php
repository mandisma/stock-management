<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductMovementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductMovement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $action = $this->getRandomAction();
        $price_ht = null;

        if ($action === ProductMovement::ACTION_ADD) {
            $price_ht = $this->faker->randomFloat(2, 1, 500);
        }

        return [
            'product_id' => Product::factory(),
            'quantity' => $this->faker->randomNumber(2),
            'price_ht' => $price_ht,
            'action' => $action,
        ];
    }

    public function getRandomAction()
    {
        $actions = [ProductMovement::ACTION_ADD, ProductMovement::ACTION_REMOVE];

        return $actions[random_int(0, 1)];
    }
}
