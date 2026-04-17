<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class singleEmployeeController extends Controller
{

    public function edit(string $id)
    {
        $editEmp = DB::table('employees')->where('employee_id', $id)->first();

        // Pass the employee data to the view
        return view('profile.partials.edit', compact('editEmp'));
    }

    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional photo validation
        ]);
    
        // Prepare the data for updating
        $data = [
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
        ];
    
        $image = $request->file('photo');
    
        if ($image) {
            // Handle the image upload
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $upload_path = 'image/employee/';
            $image_url = $upload_path . $image_name;
            
            // Move the image to the designated folder
            $success = $image->move($upload_path, $image_name);
    
            if ($success) {
                $data['photo'] = $image_url;
    
                // Retrieve old image path
                $oldImage = DB::table('employees')->where('id', $id)->first();
                if ($oldImage && file_exists($oldImage->photo)) {
                    unlink($oldImage->photo); // Delete old image
                }
    
                // Update employee record
                $updateUser = DB::table('employees')->where('id', $id)->update($data);
    
                if ($updateUser) {
                    $notification = [
                        'message' => 'Successfully Updated',
                        'alert-type' => 'success'
                    ];
                    return redirect()->back()->with($notification);
                } else {
                    $notification = [
                        'message' => 'Failed to update employee information',
                        'alert-type' => 'error'
                    ];
                    return redirect()->back()->with($notification);
                }
            }
        } else {
            // If no new image, update employee record without changing the photo
            $updateUser = DB::table('employees')->where('id', $id)->update($data);
            if ($updateUser) {
                $notification = [
                    'message' => 'Employee Updated Successfully',
                    'alert-type' => 'success'
                ];
                return redirect()->back()->with($notification);
            } else {
                return redirect()->back()->with([
                    'message' => 'Failed to update employee information',
                    'alert-type' => 'error'
                ]);
            }
        }
    }

}
