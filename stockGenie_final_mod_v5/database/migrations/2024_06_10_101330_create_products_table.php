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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('cat_id');
            $table->string('sup_id');
            $table->string('product_code');
            $table->string('product_garage');
            $table->string('product_route');
            $table->string('product_image');
            $table->string('product_qty');
            $table->string('buy_date');
            $table->string('expire_date');
            $table->string('buying_price');
            $table->string('selling_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
