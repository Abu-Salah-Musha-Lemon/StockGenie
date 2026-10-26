<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
 Schema::create('sales_items', function (Blueprint $table) {
            // Basic fields for sale and product identification
            $table->id();
            $table->unsignedBigInteger('sale_id'); // Foreign key to 'sales' table
            $table->unsignedBigInteger('product_id'); // Foreign key to 'products' table

            // Basic sales item details
            $table->integer('qty')->default(1); // Quantity sold
            $table->decimal('sale_price', 10, 2); // Sale price of the product
            $table->decimal('cost_price', 10, 2); // Cost price of the product
            $table->decimal('total', 10, 2); // Total = qty * sale_price

            // Discount and tax at item level
            $table->decimal('discount', 10, 2)->default(0); // Discount on this item
            $table->decimal('tax_amount', 10, 2)->default(0); // Tax for the item
            $table->decimal('final_price', 10, 2)->nullable(); // Final price after discount and tax

            // Optional fields for product details and traceability
            $table->string('serial_number')->nullable(); // If the product has a serial number
            $table->string('batch_number')->nullable(); // If the product has a batch number
            $table->date('expiry_date')->nullable(); // Expiry date for perishable goods or regulated products

            // Warehouse and location (if applicable in the future)
            $table->unsignedBigInteger('warehouse_id')->nullable(); // Which warehouse the item is from
            $table->unsignedBigInteger('location_id')->nullable(); // Location within warehouse (if applicable)

            // Tracking who created and updated the item (important for large systems)
            $table->unsignedBigInteger('created_by'); // User who created the sale item
            $table->unsignedBigInteger('updated_by')->nullable(); // User who last updated the sale item

            // Status of the item (can be used for returns, cancellations, etc.)
            $table->string('status', 50)->default('active'); // Example: 'active', 'returned', 'canceled'

            // General remarks or extra info
            $table->text('remarks')->nullable(); // Any additional information for the sale item

            // Timestamps for record tracking
            $table->timestamps();

            // Foreign key constraints (optional)
            // $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('set null');
            // $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
