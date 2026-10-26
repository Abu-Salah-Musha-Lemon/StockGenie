<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function paginate(int $perPage = 20)
    {
        return Product::query()
            ->with(['category', 'stock'])
            ->where('is_deleted', false)
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function find(int $id): ?Product
    {
        return Product::query()
            ->with(['category', 'stock'])
            ->find($id);
    }

    public function update(int $id, array $data): void
    {
        Product::whereKey($id)
            ->update($data);
    }

    public function delete(int $id): void
    {
        Product::whereKey($id)
            ->update([
                'is_deleted' => true,
            ]);
    }
}
