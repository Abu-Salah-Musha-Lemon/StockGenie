<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewInvoiceNotification;

class CardController extends Controller
{
  
    public function store(Request $request)
    {
        $qty=$request->qty;
        $id=$request->id;
        $data = array();
        $data['id']=$request->id;
        $data['name']=$request->name;
        $data['qty']=$request->qty;
        $data['price']=$request->price;
        // echo"<pre>";
        // print_r($data);
    
        // Retrieve the product quantity from the database
        $productQty = DB::table('products')->where('id', $id)->value('product_qty');
        if ($productQty>0&& $qty>0) {
            $add = Cart::add($data);
            $notification = array(
                'message' => 'Product added Successfully',
                'alert-type' => 'success'
            );
        
        }else{
            $notification = array(
                'message' => 'Product is not enough for sale ',
                'alert-type' => 'warning'
            );
        }
        return Redirect()->back()->with($notification);
    }



public function update(Request $request, $rowId)
{
    $qty = $request->qty;

    // Retrieve the cart item
    $cartItem = Cart::get($rowId);
    
    // Check if the cart item exists
    if (!$cartItem) {
        $notification = [
            'message' => 'Cart item not found.',
            'alert-type' => 'error'
        ];
        return Redirect()->back()->with($notification);
    }

    // Retrieve the cart item's quantity and id
    $cardQty = $cartItem->qty;
    $cardId = $cartItem->id;

    // Retrieve the product quantity from the database
    $productQty = DB::table('products')->where('id', $cardId)->value('product_qty');

    // Check if both product and cart item quantities are greater than 0
    if ($productQty !== null && $productQty > 0 && $cardQty > 0) {
        // Check if the product quantity is sufficient
        if ($productQty >= $qty) {
            $update = Cart::update($rowId, $qty);
            $notification = [
                'message' => 'Product quantity updated successfully',
                'alert-type' => 'success'
            ];
            return Redirect()->back()->with($notification);
        }
         else {
            $notification = [
                'message' => 'Product quantity is insufficient.',
                'alert-type' => 'error'
            ];
        }
    } else {
        $notification = [
            'message' => 'Cart item not found or associated product quantity is insufficient.',
            'alert-type' => 'error'
        ];
    }
    
    return Redirect()->back()->with($notification);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $rowId)
    {
        $remove = Cart::remove($rowId);
        $notification = array(
            'message' => 'Product Remove Successfully ',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function createInvoice(Request $request)
    {
        $cart = Cart::content();
       
        return view('pos.invoice',compact('cart'));
    }


    public function finalInvoice(Request $request)
    {
        $request->validate([
            'payment_status' => 'required',
            'pay'=>'required',
        ], [
            'payment_status.required' => 'Select Your Payment Method First',
            'pay.required' => 'First Paid your amount ',
        ]);

        $data= array();
        // $data['customer_id']=$request->customer_id;
        $data['order_date']=$request->order_date;
        $data['order_month']=$request->order_month;
        $data['order_year']=$request->order_year;
        $data['order_status']=$request->order_status;
        $data['total_products']=(int)$request->total_products;
        $data['sub_total']=(float) $request->sub_total;
        $data['vat']=(float) $request->vat;
        $data['total']=(float) $request->total;
        $data['payment_status']=(float) $request->payment_status;
        $data['pay']=(float) $request->pay;
        $data['due']=(float) $request->due;
        $data['returnAmount']=(float) $request->returnAmount;
        // echo "<pre>";
        // print_r($data);
        // exit;
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
        //        try {
                   
        //             $userEmail=DB::table('users')->get('email');
        //             $adminEmail = 'lemonahmed065@gmail.com'; // Replace with your admin's email address
        //             Mail::to($userEmail)->send(new NewInvoiceNotification($customer, $request->total));
        //             $notification = [
        //                 'message' => 'Invoice Created Successfully,  send email notification to admin',
        //                 'alert-type' => 'success'
        //             ];
        //             return redirect()->route('pendingOrder')->with($notification);
        //         } catch (\Exception $e) {
        //             // Handle email sending errors
        //             $notification = [
        //                 'message' => 'Invoice Created Successfully, but failed to send email notification to admin',
        //                 'alert-type' => 'warning'
        //             ];
        //             return redirect()->route('pendingOrder')->with($notification);
        //         }
        //    // }

            $notification = array(
                'message' => 'Invoice Created Successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('pendingOrder')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to Create Invoice',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
 
    
    public function duePay(Request $request, string $id) {
        // Validate the input data
        $request->validate([
            'pay' => 'required|numeric|min:0',
            'due' => 'required|numeric|min:0',
            'returnAmount' => 'required|numeric|min:0',
        ]);
    
        // Extract pay and due from the request
        $newPay = (float) $request->pay;
        $newDue = (float) $request->due;
        $returnAmount = (float) $request->returnAmount;
    
        // Retrieve existing pay and due from the database
        $order = DB::table('orders')->find($id); // Assuming the table name is 'orders'
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
    
        $oldPay = (float) $order->pay;
        $oldDue = (float) $order->due;
    
        // Calculate final pay and due
        $finalPay = $newPay + $oldPay;
        $finalDue = $oldDue - $newPay;
        $finalDue = max(0, $finalDue); // Ensure final due is not negative
    
        // Update the order in the database
        $updateSuccess = DB::table('orders')
            ->where('id', $id)
            ->update([
                'pay' => $finalPay,
                'due' => $finalDue,
                'returnAmount' => $returnAmount
            ]);
    
        if ($updateSuccess) {
            $notification = array(
                'message' => 'Due Pay Complete',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    
        return response()->json(['error' => 'Failed to update the order'], 500);
    }
    

}
