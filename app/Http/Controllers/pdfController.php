<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use PDF;
// class pdfController extends Controller
// {
//     public function downloadInvoice($orderId)
//     {
       
//         $order = DB::table('orders')
//         ->where('id', $orderId)
//         ->first();

   
//     $orderDetails = DB::table('order_details')
//                 ->join('products', 'order_details.product_id', 'products.id')
//                 ->select('products.product_name', 'order_details.*')
//                 ->where('order_details.order_id', $orderId)
//                 ->get();

//         // Generate the PDF
//         $pdf = PDF::loadView('pos.invoice_template', ['order' => $order,'orderDetails'=>$orderDetails]);

//         // Return the PDF for download
//         return $pdf->download('invoice_' . $orderId . '.pdf');
//     }
// }


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
    public function downloadInvoice($saleId)
    {
        // Sale header
        $sale = DB::table('sales')
            ->where('id', $saleId)
            ->first();

        if (!$sale) {
            abort(404, 'Sale not found');
        }

        // Sale items
        $saleItems = DB::table('sales_items')
            ->join('products', 'sales_items.product_id', '=', 'products.id')
            ->select('products.product_name', 'sales_items.*')
            ->where('sales_items.sale_id', $saleId)
            ->get();

        // Generate PDF
        $pdf = PDF::loadView('pos.invoice_template', [
            'sale' => $sale,
            'saleItems' => $saleItems
        ]);

        return $pdf->download('invoice_' . $saleId . '.pdf');
    }
}