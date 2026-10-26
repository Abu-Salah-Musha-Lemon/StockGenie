<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // use Illuminate\Support\Str;

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name'
        ]);

        DB::transaction(function () use ($request) {
            $departmentId = DB::table('departments')->insertGetId([
                'name'        => $request->name,
                'description' => $request->description,
                'slug'        => Str::slug($request->name),
                'status'      => 1,
                'created_by'  => auth()->id(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

            // DB::table('logs')->insert([
            //     'action'        => 'Created department',
            //     'department_id' => $departmentId,
            //     'user_id'       => auth()->id(),
            //     'created_at'    => now(),
            // ]);
        });


        return redirect()->back()->with('success', 'Department created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:departments,name,' . $id
        ]);

        DB::transaction(function () use ($request, $id) {
            DB::table('departments')
                ->where('id', $id)
                ->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'slug'        => Str::slug($request->name),
                    'status'      => 1,
                    'updated_at'  => now(),
                ]);
        });

        return redirect()->back()->with('success', 'Department updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Delete the department
            DB::table('departments')->where('id', $id)->delete();
            
            DB::commit();
            return redirect()->back()->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete department: '.$e->getMessage());
        }
    }

}
