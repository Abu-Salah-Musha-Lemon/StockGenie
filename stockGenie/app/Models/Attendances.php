<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;
    // Specify the table name if it is different from the plural form of the model name
    protected $table = 'attendances';

    // Define the fillable properties
    protected $fillable = [
        'user_id',
        'att_time',
        'att_date',
        'att_year',
        'attendance',
        'edit_date',
    ];

    // Optionally, you can define hidden properties
    protected $hidden = [
        // Any sensitive fields that you don't want to expose
    ];

    // Define casts for certain fields if needed
    protected $casts = [
        'user_id' => 'integer',
        // You can add more casts if required for specific fields
    ];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
