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
    public function create()
    {
        return view('employee.add_employee');
    }

    // Display all employees
    public function index()
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
        DB::beginTransaction();

        try {

            // ✅ Validation
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:employees,phone_number',
                'nid' => 'required|unique:employees,nid',
                'password' => 'required|min:8|confirmed',
                'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            // ✅ Split name
            $names = explode(' ', $request->name, 2);

            $firstName = $names[0];
            $lastName = $names[1] ?? null;

            // ✅ 1. Create User
            $userId = DB::table('users')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // ✅ 2. Upload Photo
            $photoPath = null;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/employees'), $fileName);
                $photoPath = 'uploads/employees/' . $fileName;
            }

            // ✅ 3. Insert Employee
            DB::table('employees')->insert([
                'user_id' => $userId,
                'employee_code' => 'EMP-' . time(),

                'first_name' => $firstName,
                'last_name' => $lastName,

                'phone_number' => $request->phone,
                'nid' => $request->nid,

                'address' => $request->address,
                'city' => $request->city,

                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,

                'hire_date' => now(),

                'photo' => $photoPath,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Employee created successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', $e->getMessage());
        }
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
    DB::beginTransaction();

    try {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'vacation' => 'required',
            'city' => 'required',
            'nid' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get employee
        $employee = DB::table('employees')->where('id', $id)->first();

        if (!$employee) {
            return back()->with('error', 'Employee not found');
        }

        // Prepare data
        $data = [
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'nid' => $request->nid,
            'updated_at' => now(),
        ];

        // Handle photo update
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/employees'), $fileName);
            $data['photo'] = 'uploads/employees/' . $fileName;

            // delete old photo
            if ($employee->photo && File::exists(public_path($employee->photo))) {
                File::delete(public_path($employee->photo));
            }
        }

        // Update employee table
        DB::table('employees')->where('id', $id)->update($data);

        // Update user table
        DB::table('users')
            ->where('id', $employee->user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        DB::commit();

        return redirect()->route('admin.employee.index')
            ->with('success', 'Employee updated successfully');

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
}

    // Delete an employee
   public function delete($id)
    {
        DB::beginTransaction();

        try {

            // Get employee
            $employee = DB::table('employees')->where('id', $id)->first();

            if (!$employee) {
                return back()->with('error', 'Employee not found');
            }

            // Delete photo if exists
            if ($employee->photo && File::exists(public_path($employee->photo))) {
                File::delete(public_path($employee->photo));
            }

            // Delete employee record
            DB::table('employees')->where('id', $id)->delete();

            // Delete related user
            DB::table('users')->where('id', $employee->user_id)->delete();

            DB::commit();

            return redirect()->route('admin.employee.index')
                ->with('success', 'Employee deleted successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
