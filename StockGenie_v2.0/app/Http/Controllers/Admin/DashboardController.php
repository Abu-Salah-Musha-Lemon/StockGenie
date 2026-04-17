<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardService $dashboard
    ) {}

    public function index()
    {
        return view('admin.dashboard.index', [
            'stats' => $this->dashboard->stats(),
            'recentSales' => $this->dashboard->recentSales(),
            'lowStocks' => $this->dashboard->lowStockProducts(),
        ]);
       
    }
}
