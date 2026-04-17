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
                        $table->string('invoice_no')->unique();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('warehouse_id');

            $table->decimal('subtotal', 15, 2);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2);

            $table->string('payment_status');

            $table->dateTime('sale_date');

            $table->unsignedBigInteger('created_by');

            $table->timestamps();

            // Optional foreign keys (uncomment if tables exist)
            // $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
            // $table->foreign('warehouse_id')->references('id')->on('warehouses')->cascadeOnDelete();
            // $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
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
