<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Product List
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('admin.products.index', [
            'products' =>
                $this->productService->list(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Create Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.products.add_product',
            [
                'categories' =>
                    Category::orderBy('name')->get(),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(
        ProductStoreRequest $request
    ) {

        $this->productService->store(
            $request->validated()
        );

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product created successfully'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Form
    |--------------------------------------------------------------------------
    */

    public function edit(int $product)
    {
        $productData =
            $this->productService->find($product);

        return view(
            'admin.products.edit_product',
            [
                'product' => $productData,
                'categories' =>
                    Category::orderBy('name')->get(),
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        ProductUpdateRequest $request,
        int $product
    ) {

        $this->productService->update(
            $product,
            $request->validated()
        );

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product updated successfully'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(int $product)
    {
        $this->productService->delete(
            $product
        );

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product deleted successfully'
            );
    }
}
