<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;
    // Specify the table name if it is different from the plural form of the model name
    protected $table = 'order_details';

    // Define the fillable properties
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unitCost',
        'total',
    ];

    // Optionally, you can define hidden properties
    protected $hidden = [
        // Any sensitive fields that you don't want to expose
    ];

    // Optionally, you can define casts for certain fields
    protected $casts = [
        'quantity' => 'integer',
        'unitCost' => 'integer',
        'total' => 'integer',
    ];

    // Define relationships if needed (e.g., Order and Product)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
