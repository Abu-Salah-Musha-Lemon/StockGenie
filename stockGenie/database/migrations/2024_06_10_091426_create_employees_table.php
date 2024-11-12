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
            $table->Integer('user_id')->unique(); // Make sure employee_id is unique
            //$table->string('name')->default(''); // Default empty string for name
            //$table->string('email')->default(''); // Default empty string for email
            $table->string('phone')->default(''); // Default empty string for phone
            $table->string('address')->default(''); // Default empty string for address
            $table->string('experience')->default(''); // Default empty string for experience
            $table->string('photo')->default(''); // Default empty string for photo
            $table->string('salary')->default('0'); // Default value for salary
            $table->string('vacation')->default('0'); // Default value for vacation
            $table->string('city')->default(''); // Default empty string for city
            $table->bigInteger('nid')->unsigned()->nullable(); // Keep this nullable
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
