<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function paginate()
    {
        return Product::latest()->paginate(20);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): void
    {
        Product::whereId($id)->update($data);
    }

    public function delete(int $id): void
    {
        Product::whereId($id)->delete();
    }
}
