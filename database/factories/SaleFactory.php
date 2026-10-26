<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_no' => $this->faker->unique()->word, // Unique invoice number
            'customer_id' => $this->faker->numberBetween(1, 100), // Assuming you have 100 customers
            'warehouse_id' => $this->faker->numberBetween(1, 5), // Assuming you have 5 warehouses
            'subtotal' => $this->faker->randomFloat(2, 100, 500), // Random subtotal between 100 and 500
            'discount' => $this->faker->randomFloat(2, 0, 50), // Random discount between 0 and 50
            'tax' => $this->faker->randomFloat(2, 5, 50), // Random tax between 5 and 50
            'grand_total' => $this->faker->randomFloat(2, 200, 600), // Random grand total between 200 and 600
            'payment_status' => $this->faker->randomElement(['paid', 'pending', 'partially_paid']), // Random payment status
            'pay' => $this->faker->randomFloat(2, 0, 600), // Random amount paid
            'due' => $this->faker->randomFloat(2, 0, 600), // Random amount due
            'sale_date' => $this->faker->dateTimeThisYear(), // Random sale date within this year
            'created_by' => $this->faker->numberBetween(1, 10), // Assuming 10 users exist
        ];
    }
}
