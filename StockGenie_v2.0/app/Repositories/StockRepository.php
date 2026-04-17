<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StockRepository
{
    public function lockStock(int $productId, int $warehouseId)
    {
        return DB::table('product_stocks')
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->lockForUpdate()
            ->first();
    }

    public function decrease(object $stock, int $qty): void
    {
        DB::table('product_stocks')
            ->where('id', $stock->id)
            ->update([
                'qty' => $stock->qty - $qty
            ]);
    }
}
