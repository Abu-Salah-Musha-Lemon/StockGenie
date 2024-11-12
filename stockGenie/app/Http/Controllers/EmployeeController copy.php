<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function addEmployee() {
        return view('employee.add_employee');
    }
    public function allEmployee() {
        $employees = DB::table('employees')
                    ->join('users','users.id','employees.employee_id')
                    ->select('employees.*','users.role')
                    ->get();
        // $employees=DB::table('employees');
        return view('employee.all_employee',compact('employees'));
    }

    // public function store(Request $request) {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:employees,email',
    //         'phone' => 'required|unique:employees,phone|digits_between:10,11',
            
    //         'address' => 'required',
    //         'experience' => 'required|numeric',
    //         'salary' => 'required|numeric',
    //         'vacation' => 'required|numeric',
    //         'city' => 'required',
    //         'nid' => 'required|unique:employees,nid|digits_between:10,15',
    //         'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()], 
    //     ]);
        
    //     // $encryptedNID = Crypt::encryptString($nid);

    //     $data =array();
    //     $data['name']=$request->name;
    //     $data['email']=$request->email;
    //     $data['phone']=$request->phone;
    //     $data['address']=$request->address;
    //     $data['experience']=$request->experience;
    //     $data['salary']=$request->salary;
        
    //     $data['vacation']=$request->vacation;
    //     $data['city']=$request->city;
    //     $data['nid'] = $request->nid;

    //     $image = $request->file('photo');
        
    //     if ($image) {
    //         $image_name = time().'.'.$image->getClientOriginalExtension();
    //         $upload_path = 'image/employee/';
    //         $image_url = $upload_path . $image_name;
    //         $success = $image->move($upload_path, $image_name);
            
    //         if ($success) {
    //             $data['photo'] = $image_url;
    //             $user =DB::table('users')->insert([
    //                 'name'=>$request->name,
    //                 'email'=>$request->email,
    //                 'password' => Hash::make($request->password),
    //             ]);
    //             $data['employee_id'] = $user->id;
    //             $insert = DB::table('employees')->insert($data);
    //             $notification = array(
    //                 'message' => 'Employee add successfully',
    //                 'alert-type' => 'success'
    //             );
    //             return redirect()->route('employee.all-employee')->with($notification);
    //         } else {
    //             $notification = array(
    //                 'message' => 'Employee Image is not upload',
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->back()->with($notification);
    //         }
    //     } else {
    //         $notification = array(
    //             'message' => 'Employee did not add ',
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->with($notification);
    //     }
    // }

    public function store(Request $request) {
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()], 
        ]);
        
        // Prepare data for insertion into the employees table
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['experience'] = $request->experience;
        $data['salary'] = $request->salary;
        $data['vacation'] = $request->vacation;
        $data['city'] = $request->city;
        $data['nid'] = $request->nid;
    
        // Handle the image upload
        $image = $request->file('photo');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/employee/';
            $image_url = $upload_path . $image_name;
            $success = $image->move($upload_path, $image_name);
    
            if ($success) {
                $data['photo'] = $image_url;
    
                // Insert user into the users table and get the inserted user ID
                $userId = DB::table('users')->insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
    
                // Set the employee_id in the employee data
                $data['employee_id'] = $userId;
    
                // Insert the employee record into the employees table
                $insert = DB::table('employees')->insert($data);
    
                // Notify and redirect
                $notification = array(
                    'message' => 'Employee added successfully',
                    'alert-type' => 'success'
                );
                return redirect()->route('employee.all-employee')->with($notification);
    
            } else {
                // Handle the image upload failure
                $notification = array(
                    'message' => 'Employee Image could not be uploaded',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            // Handle missing photo case
            $notification = array(
                'message' => 'Employee did not add because photo was not uploaded',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    

    //view single employee
    public function viewEmployee($id) 
    {
        $single = DB::table('employees')
                        ->where('id',$id)
                        ->first();
    
           return view('employee.view_employee',compact('single'));
    }

    // edit single employee
    public function editEmployee($id) {
        $editUser = DB::table('employees')
                        ->where('id',$id)
                        ->first();
                return view('employee.edit_employee',compact('editUser'));      
                    
    }
    // update single employee
	public function updateEmployee(Request $request,$id) {
	
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
			$data =array();
			$data['name']=$request->name;
			$data['email']=$request->email;
			$data['phone']=$request->phone;
			$data['address']=$request->address;
			$data['experience']=$request->experience;
			$data['salary']=$request->salary;
			
			$data['vacation']=$request->vacation;
			$data['city']=$request->city;
			$data['nid']=$request->nid;

			$image = $request->file('photo');

			if ($image) {
					$image_name = time().'.'.$image->getClientOriginalExtension();
					$upload_path = 'image/employee/';
					$image_url = $upload_path . $image_name;
					$success = $image->move($upload_path, $image_name);
					
					if ($success) {
							$data['photo'] = $image_url;
	
							// Retrieve old image path
							$img = DB::table('employees')->where('id', $id)->first();
							$img_path = $img->photo;
	
							// Delete old image
							if (file_exists($img_path)) {
									unlink($img_path);
							}
	
							// Update employee record
							$updateUser = DB::table('employees')->where('id', $id)->update($data);
	
							if ($updateUser) {
									$notification = array(
											'message' => 'Successfully Updated',
											'alert-type' => 'success'
									);
									return redirect()->route('employee.all-employee')->with($notification, 'Employee Information Update');
							} else {
							$notification = array(
									'message' => 'Failed to upload image',
									'alert-type' => 'error'
							);
							return redirect()->back()->with($notification);
					}
					} 
			} else {
					// Update employee record without changing the photo
					$user = DB::table('employees')->where('id', $id)->update($data);
					if ($user) {
							$notification = array(
									'message' => 'employee Updated Successfully',
									'alert-type' => 'success'
							);
							return redirect()->route('employee.all-employee')->with($notification);
					} else {
							return redirect()->back();
					}
			}
	}

    public function deleteEmployee($id) {
        // Fetch the employee record
        $employee = DB::table('employees')->where('id', $id)->first();
    
        if ($employee) {
            // Delete the photo if it exists
            $photo = $employee->photo;
            if ($photo && file_exists(public_path($photo))) {
                unlink(public_path($photo));
            }
    
            // Delete the employee record
            $deleteUser = DB::table('employees')->where('id', $id)->delete();
    
            // Optionally delete associated user record if needed
            // Assuming user_id is stored in employees table
            if ($deleteUser) {
                // Only delete the user if the employee was successfully deleted
                DB::table('users')->where('id', $employee->employee_id)->delete();
    
                $notification = [
                    'message' => 'Employee deleted successfully',
                    'alert-type' => 'success'
                ];
                return redirect()->route('employee.all-employee')->with($notification);
            } else {
                $notification = [
                    'message' => 'Failed to delete employee',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = [
                'message' => 'Employee not found',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
    }
    
}
