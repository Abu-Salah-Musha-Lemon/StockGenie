<?php
namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use DB;
use Toastr;
use Alert;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = DB::table('suppliers')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone|digits_between:10,11',
            'address' => 'required',
            'type' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shopeName' => 'required',
        ]);
        $data =array();
        $data['name']=$request->name;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['type']=$request->type;
        $data['shopeName']=$request->shopeName;

        $image = $request->file('photo');
        if ($image) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $upload_path = 'image/supplier/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
            
            if ($success) {
                $data['photo'] = $image_url;
                $insert = DB::table('suppliers')->insert($data);
                $notification = array(
                    'message' => 'Supplier & image  add successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('suppliers.index')->with($notification);
                }
            } else {
                $notification = array(
                    'message' => 'Supplier add Successfully',
                    'alert-type' => 'warning'
                );
                $insert = DB::table('suppliers')->insert($data);
                return redirect()->route('suppliers.index')->with($notification);
            }
            $notification = array(
                'message' => 'Supplier add Successfully',
                'alert-type' => 'success'
            );
            $insert = DB::table('suppliers')->insert($data);
            return redirect()->route('suppliers.index')->with($notification);
    }

      
        


        
        
    

    public function edit($id)
    {
        $supplier = Suppliers::findOrFail($id);
        return response()->json($supplier);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone|digits_between:10,11',
            'address' => 'required',
            'type' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shopeName' => 'required',
        ]);

        $supplier = Suppliers::findOrFail($id);
        $data = $request->except('photo');

        if ($image = $request->file('photo')) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $upload_path = 'image/supplier/';
            $image->move($upload_path, $image_name);

            if (file_exists($supplier->photo)) {
                unlink($supplier->photo);
            }
            $data['photo'] = $upload_path.$image_name;
        }

        $supplier->update($data);
        Toastr::success('Supplier updated successfully');
        return redirect()->route('suppliers.index');
    }

    public function destroy($id)
    {
        $supplier = Suppliers::findOrFail($id);
        if ($supplier->photo && file_exists($supplier->photo)) {
            unlink($supplier->photo);
        }
        $supplier->delete();
        Toastr::success('Supplier deleted successfully');
        return redirect()->route('suppliers.index');
    }
}
