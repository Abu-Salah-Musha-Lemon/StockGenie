<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the plural form of the model name
    protected $table = 'expenses';

    // Define the fillable properties
    protected $fillable = [
        'details',
        'amount',
        'date',
        'month',
        'year',
    ];

    // Optionally, you can define hidden properties
    protected $hidden = [
        // Any sensitive fields that you don't want to expose
    ];

    // Define casts for certain fields if needed
    protected $casts = [
        'amount' => 'decimal:2', // If amount should be a decimal
    ];
}
