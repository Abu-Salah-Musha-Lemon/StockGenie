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
            'product_name' => $this->faker->word,
            'cat_id' => \App\Models\Category::factory(), // Assuming you have a Category model and factory
            'sup_id' => \App\Models\Suppliers::factory(), // Assuming you have a Supplier model and factory
            'product_code' => $this->faker->unique()->word,
            'product_qty' => $this->faker->numberBetween(1, 100),
            'product_garage' => $this->faker->word,
            'product_route' => $this->faker->word,
            'buy_date' => $this->faker->date,
            'expire_date' => $this->faker->date,
            'buying_price' => $this->faker->randomFloat(2, 1, 100),
            'selling_price' => $this->faker->randomFloat(2, 1, 100),
            'product_image' => $this->faker->imageUrl(640, 480, 'products'), // Fake image URL
        ];
    }
}
