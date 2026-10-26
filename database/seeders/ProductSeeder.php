<?php

namespace Database\Seeders;
use App\Models\Product;
use App\Models\ProductStock;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->count(100)->create(); 
        // ProductStock::factory()->count(10)->create();
        Product::factory()
        ->count(100)
        ->create()
        ->each(function ($product) {

            ProductStock::factory()->create([
                'product_id' => $product->id,
            ]);

        });


    }
}
