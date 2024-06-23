<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $category = DB::table('category')->get();
        return view('category.index', compact('category'));
    }

    public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|unique:category,category_name'
    ], [
        'category_name.unique' => 'Category Name already exists.'
    ]);

    $inserted = DB::table('category')->insert([
        'category_name' => $request->input('category_name'),
        // 'created_at' => now(),
        // 'updated_at' => now()
    ]);

    if ($inserted) {
        $notification = array(
            'message' => 'Category created successfully.',
            'alert-type' => 'success'
        );
    } else {
        $notification = array(
            'message' => 'Failed to create category.',
            'alert-type' => 'error'
        );
    }

    return redirect()->back()->with($notification);
}


    public function edit($id)
    {
        $category = DB::table('category')->where('id', $id)->first();
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $updated = DB::table('category')->where('id', $id)->update([
            'category_name' => $request->input('category_name'),
            'updated_at' => now()
        ]);

        if ($updated) {
            $notification = array(
                'message' => 'Category updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('category.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to update category.',
                'alert-type' => 'error'
            );
            return redirect()->route('category.index')->with($notification);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('category')->where('id', $id)->delete();

        if ($deleted) {
            $notification = array(
                'message' => 'Category deleted successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('category.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to delete category.',
                'alert-type' => 'error'
            );
            return redirect()->route('category.index')->with($notification);
        }
    }
}
