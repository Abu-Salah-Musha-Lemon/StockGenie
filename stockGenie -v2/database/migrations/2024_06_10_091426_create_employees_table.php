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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('experience');
            $table->string('photo');
            $table->string('salary');
            $table->string('vacation');
            $table->string('city');
            $table->bigInteger('nid')->unsigned()->nullable(); // Change data type to bigInteger
            $table->timestamps();
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('experience')->nullable()->change();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
