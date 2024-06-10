<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categories_name' => 'required'
        ]);

        $inserted = DB::table('categories')->insert([
            'categories_name' => $request->input('categories_name'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($inserted) {
            $notification = array(
                'message' => 'Category created successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('categories.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to create category.',
                'alert-type' => 'error'
            );
            return redirect()->route('categories.index')->with($notification);
        }
    }

    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categories_name' => 'required'
        ]);

        $updated = DB::table('categories')->where('id', $id)->update([
            'categories_name' => $request->input('categories_name'),
            'updated_at' => now()
        ]);

        if ($updated) {
            $notification = array(
                'message' => 'Category updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('categories.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to update category.',
                'alert-type' => 'error'
            );
            return redirect()->route('categories.index')->with($notification);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('categories')->where('id', $id)->delete();

        if ($deleted) {
            $notification = array(
                'message' => 'Category deleted successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('categories.index')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to delete category.',
                'alert-type' => 'error'
            );
            return redirect()->route('categories.index')->with($notification);
        }
    }
}
