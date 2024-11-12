<?php

namespace Database\Factories;
use App\Models\Suppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suppliers>
 */
class SuppliersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Suppliers::class;
    public function definition(): array
    {
         return [
        'name' => $this->faker->company, // Generates a random company name
        'phone' => $this->faker->phoneNumber, // Generates a random phone number
        'address' => $this->faker->address, // Generates a random address
        'type' => $this->faker->word, // Generates a random word for type
        'shopName' => $this->faker->word, // Generates a random word for shop name
    ];
    
    }
}
