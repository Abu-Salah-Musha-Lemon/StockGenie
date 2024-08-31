<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;
use DB;
class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = DB::table('suppliers')->get();
        return view('supplier.all_supplier',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validating the incoming request
    $validated = $request->validate([
        'name' => 'required',
        'phone' => 'required|unique:suppliers,phone|digits_between:10,11',
        'address' => 'required',
        'type' => 'required',
        'shopName' => 'required',
    ], [
        'type' => 'Select the Supplier Type.'
    ]
    );

   
        // Creating an array of data to insert into the database
        $data = [
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'type' => $request->input('type'),
            'shopName' => $request->input('shopName'),
        ];

        // Inserting data into the database
        $insert = DB::table('suppliers')->insert($data);

        if ($insert) {
            // Data inserted successfully
            $notification = [
                'message' => 'Supplier added successfully',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        } else {
            // Insert failed
            $notification = [
                'message' => 'Failed to add supplier',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
   
    $notification = [
        'message' => 'Input all the data Correctly',
        'alert-type' => 'error'
    ];
    return redirect()->back()->with($notification);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $single = DB::table('suppliers')
        ->where('id',$id)
        ->first();
        // var_dump( $singleUser);
        return view('supplier.view_supplier',compact('single'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editUser = DB::table('suppliers')
                        ->where('id',$id)
                        ->first();
                return view('supplier.edit_supplier',compact('editUser'));  
    }

    
    public function update(Request $request, $id)
    {
        // Validating the incoming request
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|digits_between:11,14',
            'address' => 'required',
            'type' => 'required',
            'shopName' => 'required',
        ]);
    
        try {
            // Creating an array of data to update the record
            $data = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'type' => $request->input('type'),
                'shopName' => $request->input('shopName'),
            ];
    
            // Updating the record in the database
            $updateUser = DB::table('suppliers')->where('id', $id)->update($data);
    
            if ($updateUser) {
                // Update successful
                $notification = [
                    'message' => 'Successfully Updated',
                    'alert-type' => 'success'
                ];
                return redirect()->route('supplier.all-supplier')->with($notification);
            } else {
                // Update failed
                $notification = [
                    'message' => 'Failed to Update',
                    'alert-type' => 'error'
                ];
                return redirect()->route('supplier.all-supplier')->with($notification);
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            ];
            return redirect()->back()->withInput()->with($notification);
        }
    }
    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = DB::table('suppliers')
            ->where('id', $id)
            ->delete();
    
        if ($delete) {
                $notification = array(
                    'message' => 'Supplier Deleted Successfully',
                    'alert-type' => 'success'
                );
            return redirect()->back()->with($notification);
        } else {
            
                $notification = array(
                    'message' => 'Supplier not Deleted ',
                    'alert-type' => 'warning'
                );
            // Handle case where supplier with the given ID doesn't exist
            return redirect()->back()->with($notification);
        }
    }
    
}
