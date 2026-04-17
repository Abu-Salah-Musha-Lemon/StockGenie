<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
        // Specify the table name if it is different from the plural form of the model name
        protected $table = 'orders';

        // Define the fillable properties
        protected $fillable = [
            'customer_id',
            'order_date',
            'order_month',
            'order_year',
            'order_status',
            'total_products',
            'sub_total',
            'vat',
            'total',
            'payment_status',
            'pay',
            'due',
            'returnAmount',
        ];
    
        // Optionally, you can define hidden properties
        protected $hidden = [
            // Any sensitive fields that you don't want to expose
        ];
    
        // Define casts for certain fields
        protected $casts = [
            'sub_total' => 'decimal:2',
            'vat' => 'decimal:2',
            'total' => 'decimal:2',
            'pay' => 'decimal:2',
            'due' => 'decimal:2',
            'returnAmount' => 'decimal:2',
            'customer_id' => 'integer',
            'total_products' => 'integer',
        ];
    
        // Define relationships if needed
        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
    
        public function orderDetails()
        {
            return $this->hasMany(OrderDetail::class);
        }
}
