<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesItem>
 */
class SalesItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'sale_id' => $this->faker->numberBetween(1, 100), // Random sale ID
            'product_id' => $this->faker->numberBetween(1, 50), // Random product ID
            'qty' => $this->faker->numberBetween(1, 10), // Random quantity sold
            'sale_price' => $this->faker->randomFloat(2, 10, 500), // Random sale price between 10 and 500
            'cost_price' => $this->faker->randomFloat(2, 5, 300), // Random cost price between 5 and 300
            'total' => function (array $attributes) {
                return $attributes['qty'] * $attributes['sale_price']; // Total = qty * sale_price
            },
            'discount' => $this->faker->randomFloat(2, 0, 50), // Random discount between 0 and 50
            'tax_amount' => $this->faker->randomFloat(2, 0, 50), // Random tax amount
            'final_price' => $this->faker->randomFloat(2, 0, 500), // Random final price
            'serial_number' => $this->faker->word, // Random serial number
            'batch_number' => $this->faker->word, // Random batch number
            'expiry_date' => $this->faker->dateTimeBetween('now', '+1 years')->format('Y-m-d'), // Random expiry date within a year
            'warehouse_id' => $this->faker->numberBetween(1, 5), // Random warehouse ID
            'location_id' => $this->faker->numberBetween(1, 10), // Random location ID
            'created_by' => $this->faker->numberBetween(1, 10), // Random user ID who created the sale item
            'updated_by' => $this->faker->numberBetween(1, 10), // Random user ID who last updated the sale item
            'status' => $this->faker->randomElement(['active', 'returned', 'canceled']), // Random status
            'remarks' => $this->faker->text, // Random remarks text
        ];
    }
}
