<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


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
        $employees = DB::table('employees')->get();
        // $employees=DB::table('employees');
        return view('employee.all_employee',compact('employees'));
    }

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
        ]);
        
        // $encryptedNID = Crypt::encryptString($nid);


        $data =array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['address']=$request->address;
        $data['experience']=$request->experience;
        $data['salary']=$request->salary;
        
        $data['vacation']=$request->vacation;
        $data['city']=$request->city;
        // $data['nid']=base64_encode($request->nid);
        // $data['nid'] = Crypt::encryptString($request->nid);
        $data['nid'] = $request->nid;


        $image = $request->file('photo');
        // var_export($data);

        // exit;
        
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
                return redirect()->route('employee.all-employee')->with($notification);
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


    // delete single employee
    public function deleteEmployee($id) {
        $delete = DB::table('employees')
                        ->where('id',$id)
                        ->first();
                        $photo=$delete->photo;
                        // var_dump( $singleUser);
        if ($photo && file_exists($photo)) {
            unlink($photo);
        }
        
        $deleteUser=DB::table('employees')
                    ->where('id',$id)
                    ->delete();
        if ($deleteUser) {
            $notification = array(
                'message' => 'Employee Delete Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('employee.all-employee')->with($notification);
        } else {
            $notification = array(
                'message' => 'Failed to Update',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
                    
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
	}}
