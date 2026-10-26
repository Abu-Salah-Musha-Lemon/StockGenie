<?php

namespace App\Services\POS;

use Illuminate\Support\Facades\DB;

class StockMovementService
{
    public function out(
        int $productId,
        int $warehouseId,
        int $qty,
        string $referenceType,
        int $referenceId,
        int $userId
    ): void {
        DB::table('stock_ledgers')->insert([
            'product_id'     => $productId,
            'warehouse_id'   => $warehouseId,
            'type'           => 'OUT',
            'qty'            => $qty,
            'reference_type' => $referenceType,
            'reference_id'   => $referenceId,
            'created_by'     => $userId,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
