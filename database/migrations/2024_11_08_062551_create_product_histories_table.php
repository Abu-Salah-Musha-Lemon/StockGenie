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
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->constrained()->onDelete('cascade');
            $table->integer('supplier_id')->constrained()->onDelete('cascade');
            $table->string('buying_price')->constrained()->onDelete('cascade');
            $table->string('selling_price')->constrained()->onDelete('cascade');
            $table->integer('quantity'); // The quantity purchased (could be positive or negative)
            $table->timestamp('changed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_histories');
    }
};
