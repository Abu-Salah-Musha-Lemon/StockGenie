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
         Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique(); // Unique invoice number for the sale
            $table->unsignedBigInteger('customer_id')->nullable(); // Foreign key to the 'customers' table
            $table->unsignedBigInteger('warehouse_id'); // Foreign key to the 'warehouses' table
            
            // Sale amounts and financial details
            $table->decimal('subtotal', 15, 2); // Subtotal before discounts and tax
            $table->decimal('discount', 15, 2)->default(0); // Discount applied to the sale
            $table->decimal('tax', 15, 2)->default(0); // Tax applied to the sale
            $table->decimal('grand_total', 15, 2); // Total amount after discount and tax

            // Payment details
            $table->string('payment_status'); // Payment status, e.g., 'paid', 'pending', 'partially_paid'
            $table->decimal('pay', 15, 2)->default(0); // Amount paid by the customer
            $table->decimal('due', 15, 2)->default(0); // Amount still due by the customer

            // Other details about the sale
            $table->dateTime('sale_date'); // Date and time of the sale
            $table->unsignedBigInteger('created_by'); // User who created the sale (reference to 'users' table)

            // Audit and track timestamps
            $table->timestamps();

            // Foreign key constraints
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            // $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
