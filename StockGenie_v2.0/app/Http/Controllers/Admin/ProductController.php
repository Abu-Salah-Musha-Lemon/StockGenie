<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {}

    public function index()
    {
        return view('admin.products.index', [
            'products' => $this->productService->list()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->create($request->validated());

        return redirect()
            ->back()
            ->with('success', 'Product created successfully');
    }

    public function update(ProductUpdateRequest $request, int $id)
    {
        $this->productService->update($id, $request->validated());

        return redirect()
            ->back()
            ->with('success', 'Product updated successfully');
    }

    public function destroy(int $id)
    {
        $this->productService->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Product deleted');
    }
}
