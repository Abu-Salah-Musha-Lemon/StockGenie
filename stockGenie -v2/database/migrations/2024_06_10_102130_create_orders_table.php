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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('order_date');
            $table->string('order_month');
            $table->string('order_year');
            $table->string('order_status');
            $table->integer('total_products');
            $table->decimal('sub_total', 15, 2); // Assuming subtotal can have up to 15 digits in total, 2 of which are after the decimal point
            $table->decimal('vat', 15, 2); // Same assumption for VAT
            $table->decimal('total', 15, 2); // Same assumption for total
            $table->string('payment_status');
            $table->decimal('pay', 15, 2)->nullable(); // Same assumption for pay
            $table->decimal('due', 15, 2)->nullable(); // Same assumption for due
            $table->decimal('returnAmount', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
