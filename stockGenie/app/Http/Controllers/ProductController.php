<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Toastr;
use Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['photo']);
        if ($image = $request->file('photo')) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/product/';
            $image->move($upload_path, $image_name);
            $data['product_image'] = $upload_path . $image_name;
        }

        Product::create($data);
        Toastr::success('Product added successfully');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['photo']);
        if ($image = $request->file('photo')) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/product/';
            $image->move($upload_path, $image_name);
            $data['product_image'] = $upload_path . $image_name;

            // Delete old image
            $old_image = Product::find($id)->product_image;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
        }

        Product::where('id', $id)->update($data);
        Toastr::success('Product updated successfully');
        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->product_image && file_exists($product->product_image)) {
            unlink($product->product_image);
        }
        $product->delete();
        Toastr::success('Product deleted successfully');
        return redirect()->route('products.index');
    }
}
