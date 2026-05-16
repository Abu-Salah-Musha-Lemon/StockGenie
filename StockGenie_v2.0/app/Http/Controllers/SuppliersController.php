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
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers,phone|digits_between:10,11|regex:/^[0-9\-\+\(\)\s]+$/',
            'address' => 'required',
            'type' => 'required',
            'shopName' => 'required',
        ], [
            'type.required' => 'Select the Supplier Type.',
        ]);

        try {

            DB::transaction(function () use ($validated) {

                DB::table('suppliers')->insert([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'type' => $validated['type'],
                    'shopName' => $validated['shopName'],
                ]);

            });

            return redirect()->back()->with([
                'message' => 'Supplier added successfully',
                'alert-type' => 'success'
            ]);

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            ]);
        }
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
        // only allows numeric digits (0-9) and counts the digits only.
        // 'phone' => 'sometimes|required|regex:/^[0-9\-\+\(\)\s]+$/',
         $request->merge([
        'phone' => preg_replace('/\D/', '', $request->phone)
        ]);

        $validated = $request->validate([
            'name' => 'sometimes|required',
            'phone' => 'sometimes|required|regex:/^[0-9\-\+\(\)\s]+$/',
            'address' => 'sometimes|required',
            'type' => 'sometimes|required',
            'shopName' => 'sometimes|required',
        ]);

        try {

            DB::transaction(function () use ($validated, $id) {

                DB::table('suppliers')
                    ->where('id', $id)
                    ->update($validated);

            });

            return redirect()
                ->route('admin.suppliers.index')
                ->with([
                    'message' => 'Successfully Updated',
                    'alert-type' => 'success'
                ]);

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'message' => $e->getMessage(),
                    'alert-type' => 'error'
                ]);
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = DB::table('suppliers')
            ->where('id', $id)
            ->delete();

        if ($deleted) {

             return response()->json([
                'message' => 'Supplier deleted successfully'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Supplier Not Found',
            'alert-type' => 'warning'
        ]);
       
    }
}
