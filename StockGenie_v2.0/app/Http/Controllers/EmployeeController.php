<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $departments = DB::table('departments')
            ->orderBy('name')
            ->get();

        $positions = DB::table('positions')
            ->orderBy('title')
            ->get();

        $roles = DB::table('roles')
            ->where('status', 1)
            ->orderBy('display_name')
            ->get();

        return view('employee.create', compact(
            'departments',
            'positions',
            'roles'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | ALL EMPLOYEES
    |--------------------------------------------------------------------------
    */

   public function index()
    {
        $employees = DB::table('employees')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->leftJoin(
                'departments',
                'departments.id',
                '=',
                'employees.department_id'
            )
            ->leftJoin(
                'positions',
                'positions.id',
                '=',
                'employees.position_id'
            )
            ->select(
                'employees.*',
                'users.role',
                'users.name',
                'users.email as user_email',
                'departments.name as department_name',
                'positions.title as position_title'
            )
            ->latest('employees.id')
            ->get();

        return view(
            'employee.index',
            compact('employees')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE EMPLOYEE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'first_name' => [
                'required',
                'string',
                'max:255',
            ],

            'last_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone_number' => [
                'required',
                'digits:11',
                'unique:employees,phone_number',
            ],

            'nid' => [
                'required',
                'string',
                'max:20',
                'unique:employees,nid',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],
            'role_id' => [
                    'required',
                    'exists:roles,id',
                ],
            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'experience' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'salary' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'vacation' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'nullable',
                'in:male,female,other',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],
        ]);

        DB::beginTransaction();

        $photoPath = null;

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK POSITION BELONGS TO DEPARTMENT
            |--------------------------------------------------------------------------
            */

            $position = DB::table('positions')
                ->where('id', $validated['position_id'])
                ->first();

            if (!$position) {
                throw new \Exception('Selected position was not found.');
            }

            if ((int) $position->department_id !== (int) $validated['department_id']) {
                throw new \Exception(
                    'Selected position does not belong to the selected department.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | CREATE USER
            |--------------------------------------------------------------------------
            */

            $fullName = trim(
                $validated['first_name'] . ' ' .
                ($validated['last_name'] ?? '')
            );

            $userId = DB::table('users')->insertGetId([

                'name' => $fullName,

                'email' => $validated['email'],

                'password' => Hash::make(
                    $validated['password']
                ),

                'role' => $validated['role_id'],

                'created_at' => now(),

                'updated_at' => now(),
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPLOAD PHOTO
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('photo')) {

                $photoPath = upload_image(
                    $request->file('photo'),
                    'employees',
                    300,
                    300,
                    80
                );
            }

            /*
            |--------------------------------------------------------------------------
            | GENERATE EMPLOYEE CODE
            |--------------------------------------------------------------------------
            */

            do {

                $employeeCode =
                    'EMP-' .
                    date('Y') .
                    '-' .
                    strtoupper(
                        substr(
                            md5(uniqid((string) mt_rand(), true)),
                            0,
                            6
                        )
                    );

                $exists = DB::table('employees')
                    ->where('employee_code', $employeeCode)
                    ->exists();

            } while ($exists);

            /*
            |--------------------------------------------------------------------------
            | CREATE EMPLOYEE
            |--------------------------------------------------------------------------
            */

            DB::table('employees')->insert([

                'user_id' => $userId,

                'employee_code' => $employeeCode,

                'first_name' => $validated['first_name'],

                'last_name' => $validated['last_name'] ?? null,

                'email' => $validated['email'],

                'phone_number' => $validated['phone_number'],

                'nid' => $validated['nid'],

                'address' => $validated['address'] ?? null,

                'city' => $validated['city'] ?? null,

                'experience' => $validated['experience'] ?? null,

                'salary' => $validated['salary'] ?? null,

                'vacation' => $validated['vacation'] ?? null,

                'date_of_birth' =>
                    $validated['date_of_birth'] ?? null,

                'gender' =>
                    $validated['gender'] ?? null,

                'hire_date' => now()->toDateString(),

                'department_id' =>
                    $validated['department_id'],

                'position_id' =>
                    $validated['position_id'],

                'photo' => $photoPath,

                'status' => 'active',

                'created_at' => now(),

                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee added successfully.',
                    'alert-type' => 'success',
                ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            /*
            |--------------------------------------------------------------------------
            | DELETE UPLOADED PHOTO IF DATABASE FAILED
            |--------------------------------------------------------------------------
            */

            if ($photoPath) {
                delete_file($photoPath);
            }

            return back()
                ->withInput(
                    $request->except([
                        'password',
                        'password_confirmation',
                    ])
                )
                ->with([
                    'message' => $e->getMessage(),
                    'alert-type' => 'error',
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW EMPLOYEE
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $employee = DB::table('employees')
            ->leftJoin(
                'departments',
                'departments.id',
                '=',
                'employees.department_id'
            )
            ->leftJoin(
                'positions',
                'positions.id',
                '=',
                'employees.position_id'
            )
            ->select(
                'employees.*',
                'departments.name as department_name',
                'positions.title as position_title'
            )
            ->where('employees.id', $id)
            ->first();

        if (!$employee) {

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee not found.',
                    'alert-type' => 'error',
                ]);
        }

        $user = DB::table('users')
            ->where('id', $employee->user_id)
            ->first();

        return view(
            'employee.view_employee',
            compact('employee', 'user')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT EMPLOYEE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $employee = DB::table('employees')
            ->where('id', $id)
            ->first();

        if (!$employee) {

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee not found.',
                    'alert-type' => 'error',
                ]);
        }

        $user = DB::table('users')
            ->where('id', $employee->user_id)
            ->first();

        $department = DB::table('departments')
            ->where('id', $employee->department_id)
            ->first();

        $position = DB::table('positions')
            ->where('id', $employee->position_id)
            ->first();

        $allDepartments = DB::table('departments')
            ->orderBy('name')
            ->get();

        $allPositions = DB::table('positions')
            ->orderBy('title')
            ->get();

        return view(
            'employee.edit_employee',
            compact(
                'employee',
                'user',
                'department',
                'position',
                'allDepartments',
                'allPositions'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE EMPLOYEE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $employee = DB::table('employees')
            ->where('id', $id)
            ->first();

        if (!$employee) {

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee not found.',
                    'alert-type' => 'error',
                ]);
        }

        $validated = $request->validate([

            'first_name' => ['required', 'string','max:255',],

            'last_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'phone_number' => [
                'required',
                'digits:11',
                'unique:employees,phone_number,' . $id,
            ],

            'nid' => [
                'required',
                'string',
                'max:20',
                'unique:employees,nid,' . $id,
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'experience' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'salary' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'vacation' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'date_of_birth' => [
                'nullable',
                'date',
            ],

            'gender' => [
                'nullable',
                'in:male,female,other',
            ],

            'department_id' => [
                'required',
                'exists:departments,id',
            ],

            'position_id' => [
                'required',
                'exists:positions,id',
            ],

            'email' => [
                'required|null',
                'email',
                'max:255',
                'unique:users,email,' . $employee->user_id,
            ],

            'name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        DB::beginTransaction();

        $newPhotoPath = null;

        try {

            /*
            |--------------------------------------------------------------------------
            | CHECK POSITION / DEPARTMENT
            |--------------------------------------------------------------------------
            */

            $position = DB::table('positions')
                ->where('id', $validated['position_id'])
                ->first();

            if (!$position) {
                throw new \Exception('Selected position was not found.');
            }

            if ((int) $position->department_id !== (int) $validated['department_id']) {
                throw new \Exception(
                    'Selected position does not belong to the selected department.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | PHOTO
            |--------------------------------------------------------------------------
            */

            $photoPath = $employee->photo;

            if ($request->hasFile('photo')) {

                $newPhotoPath = upload_image(
                    $request->file('photo'),
                    'employees',
                    300,
                    300,
                    80
                );

                $photoPath = $newPhotoPath;
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE EMPLOYEE
            |--------------------------------------------------------------------------
            */

            DB::table('employees')
                ->where('id', $id)
                ->update([

                    'first_name' =>
                        $validated['first_name'],

                    'last_name' =>
                        $validated['last_name'] ?? null,

                    'email' =>
                        $validated['email'],

                    'phone_number' =>
                        $validated['phone_number'],

                    'nid' =>
                        $validated['nid'],

                    'address' =>
                        $validated['address'] ?? null,

                    'city' =>
                        $validated['city'] ?? null,

                    'experience' =>
                        $validated['experience'] ?? null,

                    'salary' =>
                        $validated['salary'] ?? null,

                    'vacation' =>
                        $validated['vacation'] ?? null,

                    'date_of_birth' =>
                        $validated['date_of_birth'] ?? null,

                    'gender' =>
                        $validated['gender'] ?? null,

                    'department_id' =>
                        $validated['department_id'],

                    'position_id' =>
                        $validated['position_id'],

                    'photo' =>
                        $photoPath,

                    'updated_at' =>
                        now(),
                ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE USER
            |--------------------------------------------------------------------------
            */

            $userName = $validated['name'] ?? trim(
                $validated['first_name'] . ' ' .
                ($validated['last_name'] ?? '')
            );

            DB::table('users')
                ->where('id', $employee->user_id)
                ->update([

                    'name' => $userName,

                    'email' => $validated['email'],

                    'updated_at' => now(),
                ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | DELETE OLD PHOTO AFTER SUCCESSFUL COMMIT
            |--------------------------------------------------------------------------
            */

            if ($newPhotoPath && $employee->photo) {
                delete_file($employee->photo);
            }

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee updated successfully.',
                    'alert-type' => 'success',
                ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            if ($newPhotoPath) {
                delete_file($newPhotoPath);
            }

            return back()
                ->withInput()
                ->with([
                    'message' => $e->getMessage(),
                    'alert-type' => 'error',
                ]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE EMPLOYEE
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $employee = DB::table('employees')
            ->where('id', $id)
            ->first();

        if (!$employee) {

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee not found.',
                    'alert-type' => 'error',
                ]);
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | DELETE EMPLOYEE
            |--------------------------------------------------------------------------
            */

            DB::table('employees')
                ->where('id', $id)
                ->delete();

            /*
            |--------------------------------------------------------------------------
            | DELETE USER
            |--------------------------------------------------------------------------
            */

            DB::table('users')
                ->where('id', $employee->user_id)
                ->delete();

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | DELETE PHOTO AFTER DATABASE SUCCESS
            |--------------------------------------------------------------------------
            */

            if ($employee->photo) {
                delete_file($employee->photo);
            }

            return redirect()
                ->route('admin.employees.index')
                ->with([
                    'message' => 'Employee deleted successfully.',
                    'alert-type' => 'success',
                ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
}
