<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the necessary data
        $day = date("d-m-y");
        $month = date("M");
        $year = date("Y");
    
        $totalTodaySale = DB::table('orders')->where('order_date', $day)->sum('total');
        $totalMonthSale = DB::table('orders')->where('order_month', $month)->sum('total');
        $totalYearlySale = DB::table('orders')->where('order_year', $year)->sum('total');
        $totalTodayVat = DB::table('orders')->where('order_date', $day)->sum('vat');
        $totalMonthVat = DB::table('orders')->where('order_month', $month)->sum('vat');
        $totalYearlyVat = DB::table('orders')->where('order_year', $year)->sum('vat');
        $totalOrder = DB::table('orders')->sum('total_products');
        $totalProductUnitcost = DB::table('order_details')->sum('unitcost');
        $totalProductStore = DB::table('products')->sum('product_qty');
    
        // Fetch monthly sales data
        $monthlySales = DB::table('orders')
            ->select(DB::raw('SUM(pay) as total_sales, MONTH(order_date) as month'))
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->get();
    
        // Fetch today's sales data by hour
        $todaySales = DB::table('orders')
            ->select(DB::raw('SUM(pay) as total_sales, HOUR(created_at) as hour'))
            ->where('order_date', $day)
            ->groupBy(DB::raw('HOUR(created_at)'))
            ->get();
    
        // Get the authenticated user role
        $user = Auth::user();
        $role = $user->role;  // Assuming role is stored as an integer or string

        // Check if the user is an admin or an employee
        if ($role == 0) {
            // Logic for admin dashboard
            return view('dashboard', compact(
                'totalTodaySale',
                'totalMonthSale',
                'totalYearlySale',
                'totalTodayVat',
                'totalMonthVat',
                'totalYearlyVat',
                'totalOrder',
                'totalProductUnitcost',
                'totalProductStore',
                'monthlySales',
                'todaySales'
            ));
        } elseif ($role == 1) {
            // Logic for employee dashboard
            return view('dashboard', compact(
                'totalTodaySale',
                'totalMonthSale',
                'totalYearlySale',
                'totalTodayVat',
                'totalMonthVat',
                'totalYearlyVat',
                'totalOrder',
                'totalProductUnitcost',
                'totalProductStore',
                'monthlySales',
                'todaySales'
            ));
        }

        // If no role or unrecognized role, return a default dashboard or error
        abort(403, 'Unauthorized access.');
    }
}
