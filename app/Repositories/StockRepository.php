<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StockRepository
{
    public function create(array $data): void
    {
        DB::table('product_stocks')->insert([
            'product_id' => $data['product_id'],
            'qty' => $data['qty'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function findByProductId(int $productId)
    {
        return DB::table('product_stocks')
            ->where('product_id', $productId)
            ->first();
    }

    public function updateQty(
        int $productId,
        int $qty
    ): void {
        DB::table('product_stocks')
            ->where('product_id', $productId)
            ->update([
                'qty' => $qty,
                'updated_at' => now(),
            ]);
    }

    public function deleteByProductId(
        int $productId
    ): void {
        DB::table('product_stocks')
            ->where('product_id', $productId)
            ->delete();
    }
}
