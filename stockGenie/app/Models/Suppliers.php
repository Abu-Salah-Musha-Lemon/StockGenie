<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'Suppliers';
    protected $fillable = [
        'name',    
        'phone',
        'address',
        'photo',
        'shopeName',
        
    ];
}
