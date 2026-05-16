<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function stats(): array
    {
        return [
            'today_sales' => $this->todaySales(),
            'today_profit' => $this->todayProfit(),
            'month_sales' => $this->monthSales(),
            'total_due' => $this->totalDue(),
        ];
    }

    private function todaySales(): float
    {
        return (float) DB::table('sales')
            ->whereDate('sale_date', today())
            ->sum('grand_total');
    }

    private function todayProfit(): float
    {
        return (float) DB::table('sales_items')
            ->join('sales', 'sales.id', '=', 'sales_items.sale_id')
            ->whereDate('sales.sale_date', today())
            ->selectRaw('SUM((sale_price - cost_price) * qty) as profit')
            ->value('profit') ?? 0;
    }

    private function monthSales(): float
    {
        return (float) DB::table('sales')
            ->whereMonth('sale_date', now()->month)
            ->whereYear('sale_date', now()->year)
            ->sum('grand_total');
    }

    private function totalDue(): float
    {
        return (float) DB::table('sales')
            ->where('payment_status', 'due')
            ->sum('grand_total');
    }

    public function recentSales()
    {
        return DB::table('sales')
            ->orderByDesc('id')
            ->limit(10)
            ->get([
                'invoice_no',
                'grand_total',
                'payment_status',
                'sale_date',
            ]);
    }

    public function lowStockProducts()
    {
        return DB::table('product_stocks')
            ->join('products', 'products.id', '=', 'product_stocks.product_id')
            ->whereColumn('product_stocks.qty', '<=', 'products.alert_qty')
            ->get([
                'products.name',
                'product_stocks.qty',
            ]);
    }
}
