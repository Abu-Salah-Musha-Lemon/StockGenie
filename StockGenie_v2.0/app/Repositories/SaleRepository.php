<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class SaleRepository
{
    public function createSale(array $data, int $userId)
    {
        $saleId = DB::table('sales')->insertGetId([
            'invoice_no'    => $data['invoice_no'],
            'customer_id'   => $data['customer_id'] ?? null,
            'warehouse_id'  => $data['warehouse_id'],
            'subtotal'      => $data['subtotal'],
            'discount'      => $data['discount'] ?? 0,
            'tax'           => $data['tax'] ?? 0,
            'grand_total'   => $data['grand_total'],
            'payment_status'=> $data['payment_status'],
            'sale_date'     => now(),
            'created_by'    => $userId,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return (object) ['id' => $saleId];
    }

    public function addItem(int $saleId, array $item): void
    {
        DB::table('sale_items')->insert([
            'sale_id'     => $saleId,
            'product_id'  => $item['product_id'],
            'qty'         => $item['qty'],
            'sale_price'  => $item['price'],
            'cost_price'  => $item['cost_price'],
            'total'       => $item['qty'] * $item['price'],
        ]);
    }
}
