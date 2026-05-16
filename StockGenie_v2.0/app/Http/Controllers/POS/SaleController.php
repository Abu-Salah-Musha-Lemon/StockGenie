<?php
namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleStoreRequest;
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
            ->route('pos.sales.index')
            ->with('success', 'Sale completed successfully');
    }

    public function index()
    {
        return view('pos.pos');
    }
}