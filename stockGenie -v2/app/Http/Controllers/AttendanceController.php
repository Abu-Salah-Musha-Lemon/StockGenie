<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use Illuminate\Http\Request;
use DB;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $date=DB::table('attendances')->select('edit_date')->groupBy('edit_date')->get();
        return view('attendance.all_attendance',compact('date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = DB::table('employees')->get();
        return view('attendance.take_attendance',compact('employees'));
    }

    public function store(Request $request)
{   
    $today = $request->att_date;

    $table = DB::table('attendances')->where('att_date',$today)->first();

    if ($table !=null) {
        $notification = array(
                    'message' => 'Attendance already Taken ',
                    'alert-type' => 'error'
                ); 
                return redirect()->back()->with($notification);
                
    }else{
            $data = [];
                foreach ($request->attendance as $user_id => $attendance) {
                    $data[] = [
                        'user_id' => $user_id,
                        'att_date' => $request->att_date,
                        'att_year' => $request->att_year,
                        'attendance' => $attendance,
                        'edit_date' => date('d_m_y'), // If you're capturing edit date as well
                    ];
                }
                $insert = DB::table('attendances')->insert($data);
                
                // Optionally, you might want to check if the insertion was successful
                if ($insert) {
                    $notification = array(
                        'message' => 'Attendance recorded successfully ',
                        'alert-type' => 'success'
                    ); 
                    return redirect()->route('allAttendance')->with($notification);
                } else {
                    return redirect()->back()->with('error', 'Failed to record attendance.');
                }
    }
   
}

    
    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
        $allAtt = DB::table('attendances')
        ->join('employees','employees.id','attendances.user_id')
        ->select('employees.name','attendances.*')
        ->where('attendances.id',$attendance)
        ->first();
        return view('attendance.all_attendance',compact('allAtt'));
        // return $allAtt;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $edit_date)
    {
        $date=DB::table('attendances')->where('edit_date',$edit_date)->first();
       $data = DB::table('attendances')
       ->join('employees','attendances.user_id','employees.id')
       ->select('employees.name','employees.photo','attendances.*')
       ->get();
       
       return view('attendance.edit_attendance',compact('data','date'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $data = [];
        foreach ($request->attendance as $id => $attendance) {
            $data[] = [
                'id' => $id,
                'att_date' => $request->att_date,
                'att_year' => $request->att_year,
                'attendance' => $attendance,
            ];
        }
    
        // Now you have an array of attendance data with correct keys
    
        // You can perform the update operation here using $data array
    
        // Example update operation:
        foreach ($data as $attendanceData) {
            DB::table('attendances')
                ->where('id', $attendanceData['id'])
                ->update([
                    'att_date' => $attendanceData['att_date'],
                    'att_year' => $attendanceData['att_year'],
                    'attendance' => $attendanceData['attendance'],
                    // Add more columns to update if necessary
                ]);
        }
    
        // You might want to add success/error handling here
    
        return redirect()->route('allAttendance')->with('message', 'Attendance updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        // Assuming $request->edit_date contains the edit date of the attendance records to delete
        $edit_date = $request->edit_date;
    
        // Delete attendance records based on edit_date
        $delete = DB::table('attendances')->where('edit_date', $edit_date)->delete();
        
        if ($delete) {
            // Deletion successful, redirect back with a success message
            return redirect()->back()->with('message', 'Attendance records deleted successfully');
        } else {
            // Deletion failed, redirect back with an error message
            return redirect()->back()->with('error', 'Failed to delete attendance records');
        }
    }
    
}
