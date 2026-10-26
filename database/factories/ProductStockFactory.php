<?php

namespace Database\Factories;

use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductStockFactory extends Factory
{
    protected $model = ProductStock::class;

    public function definition(): array
    {
        return [
            'product_id' => null,
            'qty' => fake()->numberBetween(0, 500),
            'alert_qty' => fake()->numberBetween(1, 20),
        ];
    }
}
