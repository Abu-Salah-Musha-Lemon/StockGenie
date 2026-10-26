<?php

namespace App\Services\POS;

use App\Repositories\SaleRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class SaleService
{
    public function __construct(
        private readonly SaleRepository $saleRepo,
        private readonly StockRepository $stockRepo,
        private readonly StockMovementService $stockMovement
    ) {}

    public function createSale(array $data, int $userId): void
    {
        DB::transaction(function () use ($data, $userId) {

            // 1️⃣ Create Sale (master)
            $sale = $this->saleRepo->createSale($data, $userId);

            // 2️⃣ Sale Items + Stock handling
            foreach ($data['items'] as $item) {

                // 🔒 Lock stock row (race condition killer)
                $stock = $this->stockRepo->lockStock(
                    $item['product_id'],
                    $data['warehouse_id']
                );

                if ($stock->qty < $item['qty']) {
                    throw new Exception(
                        "Insufficient stock for product ID {$item['product_id']}"
                    );
                }

                // 3️⃣ Reduce stock
                $this->stockRepo->decrease(
                    $stock,
                    $item['qty']
                );

                // 4️⃣ Ledger entry (audit backbone)
                $this->stockMovement->out(
                    productId: $item['product_id'],
                    warehouseId: $data['warehouse_id'],
                    qty: $item['qty'],
                    referenceType: 'sale',
                    referenceId: $sale->id,
                    userId: $userId
                );

                // 5️⃣ Save sale item
                $this->saleRepo->addItem($sale->id, $item);
            }
        });
    }
}
