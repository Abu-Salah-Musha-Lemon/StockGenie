<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cart;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the customer data
        $validated = $request->validate([
            'customerName' => 'required|string|max:255',
            'customerPhone' => 'required|string|max:15',
            // Other fields if necessary
        ]);
    
        // Insert customer data
        $customerData = [
            'name' => $request->customerName,
            'phone' => $request->customerPhone,
        ];
        $insert = DB::table('customers')->insert($customerData);

        $data= array();
        // $data['customer_id']=$request->customer_id;
        $data['order_date']=$request->order_date;
        $data['order_month']=$request->order_month;
        $data['order_year']=$request->order_year;
        $data['order_status']=$request->order_status;
        $data['total_products']=$request->total_products;
        $data['payment_status'] =  $request->payment_status;
        $data['sub_total'] = floatval(str_replace(',', '', $request->sub_total));
        $data['vat'] = floatval(str_replace(',', '', $request->vat));
        $data['total'] = floatval(str_replace(',', '', $request->total));
        $data['pay'] = floatval(str_replace(',', '', $request->pay));
        $data['due'] = floatval(str_replace(',', '', $request->due));
        $data['returnAmount'] = floatval(str_replace(',', '', $request->returnAmount));

        // $order_id = DB::table('orders')->insert($data);
        $order_id = DB::table('orders')->insertGetId($data);

        if ($order_id) {
            $contentsCart = Cart::content();
            foreach ($contentsCart as $row) {
                $orderData = [
                    'order_id' => $order_id,
                    'product_id' => $row->id,
                    'quantity' => $row->qty,
                    'unitcost' => $row->price,
                    'total' => $row->total,
                ];
                DB::table('order_details')->insert($orderData);
                DB::table('products')
                ->where('id', $row->id)
                ->decrement('product_qty', $row->qty);
            }
            Cart::destroy();

            $notification = array(
                'message' => 'Invoice Created Successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('paidOrder')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to Create Invoice',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
