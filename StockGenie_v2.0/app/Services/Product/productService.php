<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepo,
        private readonly StockRepository $stockRepo
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Product List
    |--------------------------------------------------------------------------
    */

    public function list()
    {
        return $this->productRepo->paginate();
    }


    /*
    |--------------------------------------------------------------------------
    | Store Product + Stock
    |--------------------------------------------------------------------------
    */

    public function store(array $data): void
    {
        DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Upload Photo
            |--------------------------------------------------------------------------
            */

            $photo = null;

            if (!empty($data['photo'])) {

                $photo = upload_image(
                    $data['photo'],
                    'uploads/products',
                    500,
                    500,
                    80
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Create Product
            |--------------------------------------------------------------------------
            */

            $product = $this->productRepo->create([

                'name' => $data['name'],

                'sku' => $data['sku'],

                'barcode' =>
                    $data['barcode'] ?? null,

                'category_id' =>
                    $data['category_id'],

                'cost_price' =>
                    $data['cost_price'],

                'sale_price' =>
                    $data['sale_price'],

                'alert_qty' =>
                    $data['alert_qty'] ?? 0,

                'photo' => $photo,

                'status' =>
                    $data['status'] ?? 1,

                'is_deleted' => 0,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Create Stock
            |--------------------------------------------------------------------------
            */

            $this->stockRepo->create([

                'product_id' =>
                    $product->id,

                'qty' =>
                    $data['qty'],
            ]);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Update Product + Stock
    |--------------------------------------------------------------------------
    */

    public function update(
        int $id,
        array $data
    ): void {

        DB::transaction(function () use (
            $id,
            $data
        ) {

            $product =
                $this->productRepo->find($id);

            if (!$product) {
                abort(404);
            }


            /*
            |--------------------------------------------------------------------------
            | Product Data
            |--------------------------------------------------------------------------
            */

            $productData = [

                'name' =>
                    $data['name'],

                'sku' =>
                    $data['sku'],

                'barcode' =>
                    $data['barcode'] ?? null,

                'category_id' =>
                    $data['category_id'],

                'cost_price' =>
                    $data['cost_price'],

                'sale_price' =>
                    $data['sale_price'],

                'alert_qty' =>
                    $data['alert_qty'] ?? 0,

                'status' =>
                    $data['status'] ?? 1,
            ];


            /*
            |--------------------------------------------------------------------------
            | New Photo
            |--------------------------------------------------------------------------
            */

            if (!empty($data['photo'])) {

                $newPhoto = upload_image(
                    $data['photo'],
                    'uploads/products',
                    500,
                    500,
                    80
                );

                if ($newPhoto) {

                    /*
                    | Delete old photo
                    */

                    delete_file(
                        $product->photo
                    );

                    $productData['photo'] =
                        $newPhoto;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Update Product
            |--------------------------------------------------------------------------
            */

            $this->productRepo->update(
                $id,
                $productData
            );


            /*
            |--------------------------------------------------------------------------
            | Update Stock
            |--------------------------------------------------------------------------
            */

            if (isset($data['qty'])) {

                $this->stockRepo->updateQty(
                    $id,
                    $data['qty']
                );
            }
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Product
    |--------------------------------------------------------------------------
    */

    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {

            $product =
                $this->productRepo->find($id);

            if (!$product) {
                abort(404);
            }


            /*
            |--------------------------------------------------------------------------
            | Delete Photo
            |--------------------------------------------------------------------------
            */

            delete_file(
                $product->photo
            );


            /*
            |--------------------------------------------------------------------------
            | Delete Stock
            |--------------------------------------------------------------------------
            */

            $this->stockRepo
                ->deleteByProductId($id);


            /*
            |--------------------------------------------------------------------------
            | Soft Delete Product
            |--------------------------------------------------------------------------
            */

            $this->productRepo->delete($id);
        });
    }
}
