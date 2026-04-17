<?php

namespace App\Repositories;

use App\Models\Card;

class CardRepository
{
    public function paginate()
    {
        return Card::latest()->paginate(20);
    }

    public function create(array $data): Card
    {
        return Card::create($data);
    }

    public function update(int $id, array $data): void
    {
        Card::whereId($id)->update($data);
    }

    public function lock(int $id): Card
    {
        return Card::whereId($id)->lockForUpdate()->firstOrFail();
    }
}
