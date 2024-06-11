<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = DB::table('employees')->get();
        return view('employee.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|unique:employees,phone|digits_between:10,11',
            'address' => 'required',
            'experience' => 'required|numeric',
            'salary' => 'required|numeric',
            'vacation' => 'required|numeric',
            'city' => 'required',
            'nid' => 'required|unique:employees,nid|digits_between:10,15',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // $data = $request->all();
        $data =array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['salary']=$request->salary;
        
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        $data['nid'] = $request->nid;

        $image = $request->file('photo');

        if ($image) {
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $upload_path = 'image/employee/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
            
            if ($success) {
                $data['photo'] = $image_url;
                $insert = DB::table('employees')->insert($data);
                $notification = array(
                    'message' => 'Employee add successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('employee.index')->with($notification);
            } else {
                $notification = array(
                    'message' => 'Employee Image is not upload',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'Employee did not add ',
                'alert-type' => 'error'
            );
            // return redirect()->back()->with($notification);
        return redirect()->route('employee.index')->with($notification);
        }
    }
        
    public function show($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        return view('employee.index', compact('single'));
    }

    public function edit($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        return view('employee.index', compact('editUser'));
    }

    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'experience' => 'required',
    //         'salary' => 'required',
    //         'vacation' => 'required',
    //         'city' => 'required',
    //         'nid' => 'required',
    //         'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $data = $request->all();
    //     $image = $request->file('photo');

    //     if ($image) {
    //         $image_name = time() . '.' . $image->getClientOriginalExtension();
    //         $upload_path = 'image/employee/';
    //         $image_url = $upload_path . $image_name;
    //         $image->move($upload_path, $image_name);
    //         $data['photo'] = $image_url;

    //         // Delete old image
    //         $old_image = DB::table('employees')->where('id', $id)->value('photo');
    //         if (file_exists($old_image)) {
    //             unlink($old_image);
    //         }
    //     }

    //     DB::table('employees')->where('id', $id)->update($data);
    //     Toastr::success('Employee updated successfully');
    //     return redirect()->route('employee.index');
    // }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'vacation' => 'required',
            'city' => 'required',
            'nid' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->except(['_token', '_method', 'photo']);
        $image = $request->file('photo');
    
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/employee/';
            $image_url = $upload_path . $image_name;
            $image->move($upload_path, $image_name);
            $data['photo'] = $image_url;
    
            // Delete old image
            $old_image = DB::table('employees')->where('id', $id)->value('photo');
            if (file_exists($old_image)) {
                unlink($old_image);
            }
        }
    
        DB::table('employees')->where('id', $id)->update($data);
        
        return redirect()->route('employees.index');
    }
    
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        if ($employee->photo && file_exists($employee->photo)) {
            unlink($employee->photo);
        }
        $deleted = DB::table('employees')->where('id', $id)->delete();

        if ($deleted) {
            $notification = array(
                'message' => 'Employee deleted successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to delete category.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        // return redirect()->route('employees.index');
    }
}
