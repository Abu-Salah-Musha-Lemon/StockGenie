<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Specify the table name if it is different from the plural form of the model name
    protected $table = 'customers';

    // Define the fillable properties
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    // Optionally, you can define hidden properties
    protected $hidden = [
        // Any sensitive fields that you don't want to expose
    ];
}
