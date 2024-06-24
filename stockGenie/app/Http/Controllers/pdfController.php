<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class pdfController extends Controller
{
    public function downloadInvoice($orderId)
    {
        // Retrieve the order and its details from the database
        // $order = DB::table('orders')
        //     ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        //     ->join('products', 'order_details.product_id', '=', 'products.id')
        //     ->select('orders.*', 'order_details.*', 'products.product_name')
        //     ->where('orders.id', $orderId) // Specify the table for the 'id' column
        //     ->first();
        $order = DB::table('orders')
        ->where('id', $orderId)
        ->first();

   
    $orderDetails = DB::table('order_details')
                ->join('products', 'order_details.product_id', 'products.id')
                ->select('products.product_name', 'order_details.*')
                ->where('order_details.order_id', $orderId)
                ->get();

        // $orderDetails = DB::table('order_details')->where('order_id', $orderId)->get();

        // if (!$order || $orderDetails->isEmpty()) {
        //     return redirect()->back()->with([
        //         'message' => 'Order not found or Order details are empty',
        //         'alert-type' => 'error'
        //     ]);
        // }

        // $data = [
        //     'order_date' => $order->order_date,
        //     'order_month' => $order->order_month,
        //     'order_year' => $order->order_year,
        //     'order_status' => $order->order_status,
        //     'total_products' => $order->total_products,
        //     'payment_status' => $order->payment_status,
        //     'sub_total' => $order->sub_total,
        //     'vat' => $order->vat,
        //     'total' => $order->total,
        //     'pay' => $order->pay,
        //     'due' => $order->due,
        //     'returnAmount' => $order->returnAmount,
        //     'orderDetails' => $orderDetails
        // ];

        // Generate the PDF
        $pdf = PDF::loadView('pos.invoice_template', ['order' => $order,'orderDetails'=>$orderDetails]);

        // Return the PDF for download
        return $pdf->download('invoice_' . $orderId . '.pdf');
    }
}
