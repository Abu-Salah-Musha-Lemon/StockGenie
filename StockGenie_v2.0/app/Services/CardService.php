<?php

namespace App\Services\Card;

use App\Repositories\CardRepository;
use Illuminate\Support\Facades\DB;
use Exception;

class CardService
{
    public function __construct(
        private readonly CardRepository $cardRepo,
        private readonly CardLedgerService $ledger
    ) {}

    public function list()
    {
        return $this->cardRepo->paginate();
    }

    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {
            $card = $this->cardRepo->create($data);

            if (!empty($data['initial_balance'])) {
                $this->ledger->credit(
                    $card->id,
                    $data['initial_balance'],
                    'initial'
                );
            }
        });
    }

    public function update(int $id, array $data): void
    {
        $this->cardRepo->update($id, $data);
    }

    public function block(int $id): void
    {
        $this->cardRepo->update($id, ['status' => 'blocked']);
    }

    public function debit(int $cardId, float $amount, string $ref): void
    {
        DB::transaction(function () use ($cardId, $amount, $ref) {

            $card = $this->cardRepo->lock($cardId);

            if ($card->balance < $amount) {
                throw new Exception('Insufficient card balance');
            }

            $this->ledger->debit($cardId, $amount, $ref);
        });
    }
}
