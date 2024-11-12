<?php

namespace App\Http\Controllers;

use App\Models\productHistory;
use Illuminate\Http\Request;
use DB;

class ProductHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productQty = DB::table('product_histories')
        ->join('suppliers', 'product_histories.supplier_id', '=', 'suppliers.id')
        ->join('products', 'product_histories.product_id', '=', 'products.id')
        ->select('products.*','product_histories.*', 'suppliers.name as supplier_name', 'suppliers.id as suppliers_id')  // Aliasing the supplier name and id properly
        ->orderBy('product_histories.id', 'desc') 
        ->get();
        return view('productHistory.productUpdateHistory',compact('productQty'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(productHistory $productHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productHistory $productHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productHistory $productHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(productHistory $productHistory)
    {
        //
    }
}
