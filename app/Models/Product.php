<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'cat_id',
        'sup_id',
        'product_code',
        'product_qty',
        'product_garage',
        'product_route',
        'buy_date',
        'expire_date',
        'buying_price',
        'selling_price',
        'photo',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id');
    }
}
