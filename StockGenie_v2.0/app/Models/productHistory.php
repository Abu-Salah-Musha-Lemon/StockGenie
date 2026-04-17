<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productHistory extends Model
{
    use HasFactory;
    protected $table = 'product_histories';
    protected $fillable = ['product_id', 'supplier_id', 'selling_price','buying_price','quantity', 'created_at'];
}
