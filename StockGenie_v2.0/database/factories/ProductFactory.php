<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
       
     return [
    'name' => fake()->word(),
    'sku' => fake()->unique()->bothify('SKU-#####'),
    'barcode' => fake()->optional()->ean13(),
    'category_id' => 1, // or Category::factory()
    'cost_price' => fake()->randomFloat(2, 10, 100),
    'sale_price' => fake()->randomFloat(2, 100, 200),
    'alert_qty' => fake()->numberBetween(0, 50),
    'status' => true,
    'is_deleted' => false,
];
    }
}
