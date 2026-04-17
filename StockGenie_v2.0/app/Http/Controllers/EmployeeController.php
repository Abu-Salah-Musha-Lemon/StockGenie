<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    // Show the "Add Employee" form
    public function addEmployee()
    {
        return view('employee.add_employee');
    }

    // Display all employees
    public function allEmployee()
    {
        $employees = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->select('employees.*', 'users.role','users.name','users.email')
            ->orderBy('employees.id', 'desc')
            ->get();

        return view('employee.all_employee', compact('employees'));
    }

    // Store a new employee
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:employees,phone|digits_between:10,11',
            'address' => 'required',
            'experience' => 'required|numeric',
            'salary' => 'required|numeric',
            'vacation' => 'required|numeric',
            'city' => 'required',
            'nid' => 'required|unique:employees,nid|digits_between:10,15',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Prepare employee data
        $data = $request->only([
           'phone', 'address', 'experience', 'salary', 'vacation', 'city', 'nid'
        ]);

        // Handle the image upload
        if ($image = $request->file('photo')) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_url = 'image/employee/' . $image_name;
            $image->move(public_path('image/employee'), $image_name);
            $data['photo'] = $image_url;
        } else {
            return redirect()->back()->with([
                'message' => 'Employee image could not be uploaded',
                'alert-type' => 'error',
            ]);
        }

        // Create user and insert employee record
        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Add user ID to employee data
        $data['user_id'] = $userId;

        // Insert employee data into the employees table
        DB::table('employees')->insert($data);

        // Return success notification
        return redirect()->route('employee.all-employee')->with([
            'message' => 'Employee added successfully',
            'alert-type' => 'success',
        ]);
    }

    // View a single employee's details
    public function view($id)
    {
        $single = DB::table('employees')->where('id', $id)->first();
        $userID = $single->user_id;
        $singleUser = DB::table('users')->where('id', $userID)->first();
        return view('employee.view_employee', compact('single','singleUser'));
    }

    // Show the form to edit a single employee
    public function edit($id)
    {
        $editUser = DB::table('employees')->where('id', $id)->first();
        $userID = $editUser->user_id;
        //echo $userID;exit;
        $user = DB::table('users')->where('id', $userID)->first();
        return view('employee.edit_employee', compact('editUser','user'));
    }

    // Update an existing employee's details
    public function updateEmployee(Request $request, $id)
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

        $data = $request->only([
           'phone', 'address', 'experience', 'salary', 'vacation', 'city', 'nid'
        ]);

        // Handle image upload
        if ($image = $request->file('photo')) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_url = 'image/employee/' . $image_name;
            $image->move(public_path('image/employee'), $image_name);
            $data['photo'] = $image_url;

            // Delete the old image
            $oldEmployee = DB::table('employees')->where('id', $id)->first();
            if ($oldEmployee && File::exists(public_path($oldEmployee->photo))) {
                File::delete(public_path($oldEmployee->photo));
            }
        }
        // Update employee record
        DB::table('employees')->where('id', $id)->update($data);

        $employee = DB::table('employees')->where('id', $id)->first();// assuming employee has user_id field
        $user = DB::table('users')->where('id',$employee->user_id); // assuming employee has user_id field
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
     
        return redirect()->route('employee.all-employee')->with([
            'message' => 'Employee updated successfully',
            'alert-type' => 'success',
        ]);
    }

    // Delete an employee
    public function delete($id)
    {
        // Fetch the employee record
        $employee = DB::table('employees')->where('id', $id)->first();

        if ($employee) {
            // Delete the associated photo if exists
            if ($employee->photo && File::exists(public_path($employee->photo))) {
                File::delete(public_path($employee->photo));
            }

            // Delete the employee record
            DB::table('employees')->where('id', $id)->delete();

            // Optionally, delete the associated user if needed
            DB::table('users')->where('id', $employee->user_id)->delete();

            return redirect()->route('employee.all-employee')->with([
                'message' => 'Employee deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Employee not found',
            'alert-type' => 'error',
        ]);
    }
}
