<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Repositories\SaleStoreRequest;
use App\Services\POS\SaleService;

class SaleController extends Controller
{
    public function __construct(
        private readonly SaleService $saleService
    ) {}

    public function store(SaleStoreRequest $request)
    {
        $this->saleService->createSale(
            $request->validated(),
            auth()->id()
        );

        return redirect()
            ->back()
            ->with('success', 'Sale completed successfully');
    }
}
