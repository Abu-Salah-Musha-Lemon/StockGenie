<?php

namespace App\Http\Controllers;

use App\Models\pos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $product= DB::table('products')->get();
       
        return view('pos.pos',compact('product'));
    }

   public function pendingOrder()
    {
        $pending = DB::table('sales')
            ->where('payment_status', 'pending')
            ->get();

        return view('pos.all_pending_order', compact('pending'));
    }

    public function viewOrder($id)
    {
        // Sale header
        $sale = DB::table('sales')
            ->where('id', $id)
            ->first();

        // Sale items with product info
        $saleItems = DB::table('sales_items')
            ->join('products', 'sales_items.product_id', '=', 'products.id')
            ->select('products.product_name', 'sales_items.*')
            ->where('sales_items.sale_id', $id)
            ->get();

        return view('pos.view_pending_order', compact('sale', 'saleItems'));
    }



   public function paidOrder($id)
    {
        DB::table('sales')
            ->where('id', $id)
            ->update([
                'payment_status' => 'success'
            ]);

        return redirect()->route('paidOrder');
    }

    public function paidAllOrder()
    {
        $success = DB::table('sales')
            ->where('payment_status', 'success')
            ->get();

        return view('pos.all_paid_order', compact('success'));
    }


}
