<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    /**
     * Display the Sales Report for All Time.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all sales reports
        $allReports = DB::table('sales')->get();

        return view('salesReport.all_salesReport', compact('allReports'));
    }

    /**
     * Display the Sales Report for Today.
     *
     * @return \Illuminate\View\View
     */
    public function todaySalesReport()
    {
        // Get today's date
        $date = date("Y-m-d");

        // Fetch today's sales
        $todaySales = DB::table('sales')
            ->whereDate('sale_date', $date)
            ->get();

        // Calculate totals for today
        $total = DB::table('sales')->whereDate('sale_date', $date)->sum('grand_total');
        $subTotal = DB::table('sales')->whereDate('sale_date', $date)->sum('subtotal');
        $paid = DB::table('sales')->whereDate('sale_date', $date)->sum('pay');
        $due = DB::table('sales')->whereDate('sale_date', $date)->sum('due');
        $totalProducts = DB::table('sales_items')->whereDate('created_at', $date)->sum('qty');

        return view('salesReport.today_sales_report', compact('todaySales', 'total', 'subTotal', 'paid', 'due', 'totalProducts'));
    }

    /**
     * Display the Monthly Sales Report for the Current Month.
     *
     * @return \Illuminate\View\View
     */
    public function monthlySalesReport()
    {
        // Get current month
        $month = date("F");

        // Fetch sales for this month
        $monthlySales = DB::table('sales')
            ->whereMonth('sale_date', date("m"))
            ->get();

        // Calculate totals for the month
        $total = DB::table('sales')->whereMonth('sale_date', date("m"))->sum('grand_total');
        $subTotal = DB::table('sales')->whereMonth('sale_date', date("m"))->sum('subtotal');
        $paid = DB::table('sales')->whereMonth('sale_date', date("m"))->sum('pay');
        $due = DB::table('sales')->whereMonth('sale_date', date("m"))->sum('due');
        $totalProducts = DB::table('sales_items')->whereMonth('created_at', date("m"))->sum('qty');

        return view('salesReport.monthly_sales_report', compact('monthlySales', 'total', 'subTotal', 'paid', 'due', 'totalProducts'));
    }

    /**
     * Display the Yearly Sales Report for the Current Year.
     *
     * @return \Illuminate\View\View
     */
    public function yearlySalesReport()
    {
        // Get current year
        $year = date("Y");

        // Fetch sales for the current year
        $yearlySales = DB::table('sales')
            ->whereYear('sale_date', $year)
            ->get();
 
        // Calculate totals for the year
        $total = DB::table('sales')->whereYear('sale_date', $year)->sum('grand_total');
        $subTotal = DB::table('sales')->whereYear('sale_date', $year)->sum('subtotal');
        $paid = DB::table('sales')->whereYear('sale_date', $year)->sum('pay');
        $due = DB::table('sales')->whereYear('sale_date', $year)->sum('due');
        $totalProducts = DB::table('sales_items')->whereYear('created_at', $year)->sum('qty');
    //    var_dump($totalProducts);
    //     exit;
        return view('salesReport.yearly_sales_report', compact('yearlySales', 'total', 'subTotal', 'paid', 'due', 'totalProducts'));
    }

    /**
     * View Detailed Report for a Single Sale.
     *
     * @param  int  $saleId
     * @return \Illuminate\View\View
     */
    public function viewSale($saleId)
    {
        // Fetch the specific sale based on the ID
        $sale = DB::table('sales')
            ->where('id', $saleId)
            ->first();

        // Fetch related sale items
        $saleItems = DB::table('sales_items')
            ->where('sale_id', $saleId)
            ->get();

        return view('salesReport.view_sale', compact('sale', 'saleItems'));
    }
}