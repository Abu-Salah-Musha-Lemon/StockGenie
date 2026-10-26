<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | BASIC INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('employee_code')
                ->unique();

            $table->string('first_name');

            $table->string('last_name')
                ->nullable();

            $table->string('email')
                ->unique();

            $table->string('phone_number', 11)
                ->unique();

            $table->string('nid', 20)
                ->unique();

            $table->text('address')
                ->nullable();

            $table->string('city', 100)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | PROFESSIONAL INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('experience')
                ->nullable();

            $table->decimal('salary', 12, 2)
                ->nullable();

            $table->unsignedInteger('vacation')
                ->nullable();

            $table->date('date_of_birth')
                ->nullable();

            $table->enum('gender', [
                'male',
                'female',
                'other'
            ])->nullable();

            $table->date('hire_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | DEPARTMENT / POSITION
            |--------------------------------------------------------------------------
            */

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->foreignId('position_id')
                ->nullable()
                ->constrained('positions')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | PHOTO / STATUS
            |--------------------------------------------------------------------------
            */

            $table->string('photo')
                ->nullable();

            $table->string('status', 50)
                ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
