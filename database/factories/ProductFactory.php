<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),

            'sku' => strtoupper(
                $this->faker->unique()->bothify('SKU-####-???')
            ),

            'barcode' => $this->faker->unique()->numerify('############'),

            'category_id' => Category::factory(),

            'cost_price' => $this->faker->randomFloat(
                2,
                100,
                50000
            ),

            'sale_price' => $this->faker->randomFloat(
                2,
                50000,
                100000
            ),

            'photo' => null,

            'status' => true,

            'is_deleted' => false,
        ];
    }
}
