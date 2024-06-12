<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $allReport = DB::table('orders')
                     ->get();
    
        return view('salesReport.all_salesReport', compact('allReport'));
    }
    
    public function todaySalesReport() {
        $date= date("d-m-y");
        $today = DB::table('orders')
                    
                    ->where('order_date',$date)
                    ->get();
        return view('salesReport.today_sales_report',compact('today'));
    }
    

    public function monthlySalesReport() {
        $month= date("F");
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthly_sales_report',compact('monthly'));
    }

    
    public function JanuarySalesReport() {
        $month= "January";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function FebruarySalesReport() {
        $month= "February";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function MarchSalesReport() {
        $month= "March";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function AprilSalesReport() {
        $month= "April";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function MaySalesReport() {
        $month= "May";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function JuneSalesReport() {
        $month= "June";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function JulySalesReport() {
        $month= "July";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function AugustSalesReport() {
        $month= "August";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function SeptemberSalesReport() {
        $month= "September";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function OctoberSalesReport() {
        $month= "October";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function NovemberSalesReport() {
        $month= "November";
        $monthly =DB::table('orders')
                
                ->where('order_month',$month)
                ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function DecemberSalesReport() {
        $month= "December";
        $monthly =DB::table('orders')
        
        ->where('order_month',$month)
        ->get();
        return view('salesReport.monthSrl_sales_report',compact('monthly'));
    }
    public function yearlySalesReport() {
        $year= date("Y");
        $yearly =DB::table('orders')
        
        ->where('order_year',$year)
        ->get();
        return view('salesReport.yearly_sales_report',compact('yearly'));
    }

}
