<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product= DB::table('products')->get();
        return view('product.all_product',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'product_name' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'sup_id' => 'required|integer',
            'product_code' => 'required|string|max:50',
            'product_garage' => 'required|string|max:255',
            'product_route' => 'required|string|max:255',
            'product_qty' => 'required|integer',
            'buy_date' => 'required|date',
            'expire_date' => 'required|date|after:buy_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the size limit and allowed file types as needed
        ],
        [
            'product_name.required' => 'Enter The Product Name',
            'cat_id.required' => 'Chose any Category',
            'sup_id.required' => 'Chose The Name of Suppliers',
            'product_code.required' => 'Enter The Product Code',
            'product_garage.required' => 'Add Garage Name',
            'product_route.required' => 'Add Route Name',
            'product_qty.required' => 'Enter the Quantity of the Product',
            'buy_date.required' =>'Add Buying Date',
            'expire_date.required' =>'Enter Product Expire Date',
            'buying_price.required' => 'Enter Buying Price',
            'selling_price.required' => 'Enter Selling Price',
        ]
        );

        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['product_qty']=$request->product_qty;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $image = $request->file('photo');
        // $data['']=$request('product_image');
        
        if ($image) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $upload_path = 'image/product/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
            
            if ($success) {
                $data['product_image'] = $image_url;
                $insert = DB::table('products')->insert($data);
                $notification = array(
                    'message' => 'Add Product successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->route('allProduct')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Failed to create category.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            return redirect()->back()->withErrors(['image' => 'Image is required']);
        }
        
    }
    public function storeModal(Request $request)
    {   
        $request->validate([
            'product_name' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'sup_id' => 'required|integer',
            'product_code' => 'required|string|max:50',
            'product_garage' => 'required|string|max:255',
            'product_route' => 'required|string|max:255',
            'product_qty' => 'required|integer',
            'buy_date' => 'required|date',
            'expire_date' => 'required|date|after:buy_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the size limit and allowed file types as needed
        ],
        [
            'product_name.required' => 'Enter The Product Name',
            'cat_id.required' => 'Chose any Category',
            'sup_id.required' => 'Chose The Name of Suppliers',
            'product_code.required' => 'Enter The Product Code',
            'product_garage.required' => 'Add Garage Name',
            'product_route.required' => 'Add Route Name',
            'product_qty.required' => 'Enter the Quantity of the Product',
            'buy_date.required' =>'Add Buying Date',
            'expire_date.required' =>'Enter Product Expire Date',
            'buying_price.required' => 'Enter Buying Price',
            'selling_price.required' => 'Enter Selling Price',
        ]
        );

        $data=array();
        $data['product_name']=$request->product_name;
        $data['cat_id']=$request->cat_id;
        $data['sup_id']=$request->sup_id;
        $data['product_code']=$request->product_code;
        $data['product_garage']=$request->product_garage;
        $data['product_route']=$request->product_route;
        $data['product_qty']=$request->product_qty;
        $data['buy_date']=$request->buy_date;
        $data['expire_date']=$request->expire_date;
        $data['buying_price']=$request->buying_price;
        $data['selling_price']=$request->selling_price;
        $image = $request->file('photo');
        // $data['']=$request('product_image');
        
        if ($image) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $upload_path = 'image/product/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
            
            if ($success) {
                $data['product_image'] = $image_url;
                $insert = DB::table('products')->insert($data);
                $notification = array(
                    'message' => 'Add Product successfully.',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } else {
                $notification = array(
                    'message' => 'Failed to create category.',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            return redirect()->back()->withErrors(['image' => 'Image is required']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        // $show = DB::table('products')
        //     ->join('category', 'products.cat_id', '=', 'category.id')
        //     ->join('suppliers', 'products.sup_id', '=', 'suppliers.id')
        //     ->select('products.*', 'category.category_name', 'suppliers.name as supplier_name')
        //     ->where('products.id', $id)
        //     ->get();
        // return view('product.view_product', compact('show'));

        $show = DB::table('products')->where('id', $id)->first();
       
        $categories = DB::table('category')->get();
        $suppliers = DB::table('suppliers')->get();

        return view('product.view_product', compact('show', 'categories', 'suppliers'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = DB::table('products')
        ->where('id',$id)
        ->first();
        return view('product.edit_product',compact('edit'));  
    }
    
    public function updateProductQtyView()
    {
        $productQty = DB::table('products')
            ->join('suppliers', 'products.sup_id', '=', 'suppliers.id')
            ->select('products.*', 'suppliers.name as supplier_name', 'suppliers.id as suppliers_id')  // Aliasing the supplier name and id properly
            ->get();
        return view('product.updateProductQtyView',compact('productQty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'cat_id' => 'required|integer',
            'sup_id' => 'required|integer',
            'product_code' => 'required|string|max:50',
            'product_garage' => 'required|string|max:255',
            'product_route' => 'required|string|max:255',
            'product_qty' => 'required|integer',
            'buy_date' => 'required|date',
            'expire_date' => 'required|date|after:buy_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ], [
            'product_name.required' => 'Enter The Product Name',
            'cat_id.required' => 'Chose any Category',
            'sup_id.required' => 'Chose The Name of Suppliers',
            'product_code.required' => 'Enter The Product Code',
            'product_garage.required' => 'Add Garage Name',
            'product_route.required' => 'Add Route Name',
            'product_qty.required' => 'Enter the Quantity of the Product',
            'buy_date.required' => 'Add Buying Date',
            'expire_date.required' => 'Enter Product Expire Date',
            'buying_price.required' => 'Enter Buying Price',
            'selling_price.required' => 'Enter Selling Price',
        ]);
    
        // Prepare data for update
        $data = [
            'product_name' => $request->product_name,
            'cat_id' => $request->cat_id,
            'sup_id' => $request->sup_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_route' => $request->product_route,
            'product_qty' => $request->product_qty,
            'buy_date' => $request->buy_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
        ];
    
        // Handle image upload if exists
        $image = $request->file('photo');
        if ($image) {
            // Upload new image
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/product/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
    
            if ($success) {
                // Delete old image if exists
                $old_img = DB::table('products')->where('id', $id)->value('product_image');
                if ($old_img && file_exists(public_path($old_img))) {
                    unlink(public_path($old_img));
                }
                // Add the new image URL
                $data['product_image'] = $image_url;
            } else {
                // Handle upload failure
                return redirect()->back()->with('error', 'Failed to upload new image.');
            }
        }
    
        // Update the product record
        $updateUser = DB::table('products')->where('id', $id)->update($data);
    
        if ($updateUser) {
            // Insert into the product history table
            DB::table('product_histories')->insert([
                'product_id' => $id,
                'supplier_id' => $request->sup_id, // Correct supplier_id field
                'quantity' => $request->product_qty, // Using the updated product_qty
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'changed_at' => now()->format('Y-m-d H:i:s'), // Correct datetime format
            ]);
    
            // Return success notification
            return redirect()->route('allProduct')->with('success', 'Product updated successfully.');
        } else {
            // Handle update failure
            return redirect()->route('allProduct')->with('error', 'Failed to update product.');
        }
    }
    

    public function updateProductQtyPrice(Request $request, $id) 
    {
        // Validate the incoming request
        $validated = $request->validate([
            'updateQty' => 'required|numeric|min:0',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
        ]);

        // Retrieve the full product details from the database
        $product = DB::table('products')->where('id', $id)->first();  // This fetches the whole product row

        // Ensure product exists
        if (!$product) {
            return redirect()->route('updateProductQtyView')->with([
                'message' => 'Product not found!',
                'alert-type' => 'error'
            ]);
        }

        // Extract old values from the product
        $old_qty = (int) $product->product_qty;
        $old_buying_price = (float) $product->buying_price;
        $old_selling_price = (float) $product->selling_price;

        // Get the new values from the request
        $new_qty = (int) $request->updateQty;
        $new_buying_price = (float) $request->buying_price;
        $new_selling_price = (float) $request->selling_price;
    
        // Ensure valid input (positive quantities and prices)
        // if ($new_qty <= 0 || $new_buying_price <= 0 || $new_selling_price <= 0) {
        //     return redirect()->route('updateProductQtyView')->with([
        //         'message' => 'Product Quantity, Buying Price, and Selling Price must be positive!',
        //         'alert-type' => 'error'
        //     ]);
        // }

            // Update the quantity and prices directly
            $updated_qty = $old_qty + $new_qty; // Add the new quantity to the old quantity
            $updateBuying = $old_buying_price + $new_buying_price;
            $updateSelling = $old_selling_price + $new_selling_price;

            DB::table('products')
                ->where('id', $id)
                ->update([
                    'sup_id' => $request->supplier_id,
                    'product_qty' => $updated_qty,
                    'buying_price' => $updateBuying,
                    'selling_price' => $updateSelling,
                ]);
        
            // Insert into the product history table
            DB::table('product_histories')->insert([
                'product_id' => $id,
                'supplier_id' => $request->supplier_id,
                'quantity' => $request->updateQty,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'changed_at' => now()->format('Y-m-d h:i:s'), // Correct format for MySQL
                // 'changed_at' => date('Y-m-d'), // 'Y-m-d H:i:s' format (e.g., '2024-11-08 15:30:00')
            ]);
        
            // Return with a success message
            return redirect()->route('updateProductQtyView')->with([
                'message' => 'Product details successfully updated!',
                'alert-type' => 'success'
            ]);
    }
       
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        // Fetch the product record from the database
        $product = DB::table('products')->where('id', $id)->first();

        // Check if the product record exists
        if ($product) {
            // Retrieve the product image path
            $photo = $product->product_image;

            // Check if the image file exists and delete it
            if ($photo && file_exists($photo)) {
                unlink($photo);
            }

            // Delete the product record from the database
            DB::table('products')->where('id', $id)->delete();

            // Prepare success notification
            $notification = array(
                'message' => 'Product deleted successfully',
                'alert-type' => 'success'
            );
        } else {
            // Prepare error notification if product does not exist
            $notification = array(
                'message' => 'Product not found',
                'alert-type' => 'error'
            );
        }

        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }

}