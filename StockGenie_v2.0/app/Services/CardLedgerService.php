<?php

namespace App\Services\Card;

use Illuminate\Support\Facades\DB;

class CardLedgerService
{
    public function credit(int $cardId, float $amount, string $ref): void
    {
        DB::table('card_ledgers')->insert([
            'card_id' => $cardId,
            'type' => 'IN',
            'amount' => $amount,
            'reference' => $ref,
            'created_at' => now()
        ]);

        DB::table('cards')->where('id', $cardId)->increment('balance', $amount);
    }

    public function debit(int $cardId, float $amount, string $ref): void
    {
        DB::table('card_ledgers')->insert([
            'card_id' => $cardId,
            'type' => 'OUT',
            'amount' => $amount,
            'reference' => $ref,
            'created_at' => now()
        ]);

        DB::table('cards')->where('id', $cardId)->decrement('balance', $amount);
    }
}
