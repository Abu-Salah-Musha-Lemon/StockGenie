<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepo,
        private readonly ProductImageService $imageService
    ) {}

    public function list()
    {
        return $this->productRepo->paginate();
    }

    public function create(array $data): void
    {
        DB::transaction(function () use ($data) {

            if (!empty($data['image'])) {
                $data['image'] = $this->imageService->upload($data['image']);
            }

            $this->productRepo->create($data);
        });
    }

    public function update(int $id, array $data): void
    {
        DB::transaction(function () use ($id, $data) {

            if (!empty($data['image'])) {
                $data['image'] = $this->imageService->upload($data['image']);
            }

            $this->productRepo->update($id, $data);
        });
    }

    public function delete(int $id): void
    {
        $this->productRepo->delete($id);
    }
}
