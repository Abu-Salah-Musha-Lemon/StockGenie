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
        $product= DB::table('products')->get();
        return view('product.add_product_qty',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
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
				// 'old_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the size limit and allowed file types as needed
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
		]);

    			$data = array();
                $data['product_name'] = $request->product_name;
                $data['cat_id'] = $request->cat_id;
                $data['sup_id'] = $request->sup_id;
                $data['product_code'] = $request->product_code;
                $data['product_garage'] = $request->product_garage;
                $data['product_route'] = $request->product_route;
                $data['product_qty'] = $request->product_qty;
                $data['buy_date'] = $request->buy_date;
                $data['expire_date'] = $request->expire_date;
                $data['buying_price'] = $request->buying_price;
                $data['selling_price'] = $request->selling_price;

                $image = $request->file('photo');

                if ($image) {
                    // If a new image is uploaded
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $upload_path = 'image/product/';
                    $image_url = $upload_path . $image_name;
                    $success = $image->move($upload_path, $image_name);

                    if ($success) {
                        // Delete old image if it exists
                        $old_img = DB::table('products')->where('id', $id)->value('product_image');
                        if ($old_img && file_exists($old_img)) {
                            unlink($old_img);
                        }
                        
                        $data['product_image'] = $image_url;
                    } else {
                        // If failed to upload new image
                        $notification = array(
                            'message' => 'Old Image is not delete ',
                            'alert-type' => 'error'
                        );
                        return redirect()->back()->with($notification);
                    }
                }

                // Update product record
                $updateUser = DB::table('products')->where('id', $id)->update($data);

                if ($updateUser) {
                    $notification = array(
                        'message' => 'Successfully Updated',
                        'alert-type' => 'success'
                    );
                    return redirect()->route('allProduct')->with($notification);
                } else {
                    $notification = array(
                        'message' => 'Record Did not Update',
                        'alert-type' => 'error'
                    );
                    return redirect()->route('allProduct')->with($notification);
                }



    }


    public function updateProductQty(Request $request, $id) {
       
            $old_qty = (int)DB::table('products')->where('id', $id)->value('product_qty');
            $new_qty = (int)$request->updateQty;
            if ($new_qty>0) {
                $updateQty = $old_qty + $new_qty;
                $updateQtyValue = DB::table('products')
                                ->where('id', $id)
                                ->update(['product_qty' => $updateQty]);
                 $notification = array(
                    'message' => 'Quantity Successfully Updated',
                    'alert-type' => 'success'
                );
            } else { 
                $notification = array(
                'message' =>'Product Quantity is not negative(-) or 0',
                    'alert-type' => 'error'
                );
                
            }
       
    
        return redirect()->route('updateProductQtyView')->with($notification);
    }
    

    
    /**
     * Remove the specified resource from storage.
     */

    // public function destroy(string $id)
    // {
    //     $delete = DB::table('products')
    //     ->where('id',$id)
    //     ->first();

    //     $photo=$delete->product_image;
    //     if ($photo) {
            
    //         unlink($photo);
    //     }
    //     // var_dump( $singleUser);
    //     $deleteUser=DB::table('products')
    //                 ->where('id',$id)
    //                 ->delete();
    //                 $notification = array(
    //                     'message' =>'Product delete successfully',
    //                         'alert-type' => 'success'
    //                     );
    //                 return redirect()->back()->with($notification);
    // }
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