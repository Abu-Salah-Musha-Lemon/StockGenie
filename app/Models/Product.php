<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'barcode',
        'category_id',
        'cost_price',
        'sale_price',
        'alert_qty',
        'photo',
        'status',
        'is_deleted',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_deleted' => 'boolean',
        'cost_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

    public function stock()
    {
        return $this->hasOne(
            ProductStock::class,
            'product_id'
        );
    }


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id');
    }
}
