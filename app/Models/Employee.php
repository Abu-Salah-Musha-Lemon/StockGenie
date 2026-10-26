<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    // Specify the table name if it is different from the plural form of the model name
    protected $table = 'employees';

    // Define the fillable properties
    protected $fillable = [
        'employee_id',
        'name',
        'email',
        'phone',
        'address',
        'experience',
        'photo',
        'salary',
        'vacation',
        'city',
        'nid',
    ];

    // Optionally, you can define hidden properties
    protected $hidden = [
        // Any sensitive fields that you don't want to expose
    ];

    // Optionally, you can define casts for certain fields
    protected $casts = [
        'salary' => 'decimal:2', // Cast salary to decimal with 2 decimal points
        'vacation' => 'integer',  // Cast vacation to integer
        'nid' => 'integer',        // Cast NID to integer if applicable
    ];
}
