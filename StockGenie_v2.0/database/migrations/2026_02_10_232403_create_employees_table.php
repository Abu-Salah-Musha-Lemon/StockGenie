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

            $table->unsignedBigInteger('user_id')->unique();

            $table->string('employee_code')->unique();

            $table->string('first_name');
            $table->string('last_name')->nullable();

            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('nid')->unique();

            $table->text('address')->nullable();
            $table->string('city')->nullable();

            $table->string('experience')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->integer('vacation')->nullable();

            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male','female','other'])->nullable();

            $table->date('hire_date');

            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('position_id')->nullable();

            $table->string('photo')->nullable();

            $table->enum('status', ['active','inactive','terminated'])->default('active');

            $table->timestamps();

                        // Foreign keys
            $table->foreign('position_id')
                ->references('id')
                ->on('positions')
                ->onDelete('set null');

            // Optional (recommended if departments table exists)
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('set null');
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
