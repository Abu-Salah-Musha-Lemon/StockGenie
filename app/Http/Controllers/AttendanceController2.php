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
                            'att_time' => $request->att_time,
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
        $data = DB::table('attendances')
            ->join('employees', 'attendances.user_id', '=', 'employees.id')
            ->select('employees.name', 'employees.photo', 'attendances.*')
            ->where('attendances.edit_date', $edit_date)
            ->orderBy('attendances.att_time') // Optional: order by time
            ->get();
    
        return view('attendance.edit_attendance', compact('data'));
    }
    

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request)
     {
         // Validate the incoming data
         $request->validate([
             'attendance.*' => 'required|in:Present,Absent',
             'ids.*' => 'required|integer|exists:attendances,id',
             'new_user_id' => 'nullable|integer|exists:employees,id',
             'new_att_time' => 'nullable|date_format:H:i',
             'new_attendance_status' => 'nullable|in:Present,Absent',
         ]);
     
         // Update existing records
         foreach ($request->attendance as $id => $attendance) {
             DB::table('attendances')
                 ->where('id', $id)
                 ->update([
                     'attendance' => $attendance, // Ensure this matches the column name
                     'att_time' => $request->att_time,
                 ]);
         }
     
        //  // Insert new records
        //  if ($request->new_user_id && $request->new_att_time && $request->new_attendance_status) {
        //      DB::table('attendances')->insert([
        //          'user_id' => $request->new_user_id,
        //          'edit_date' => $request->new_edit_date,
        //          'att_time' => $request->new_att_time,
        //          'attendance' => $request->new_attendance_status, // Ensure this matches the column name
        //      ]);
        //  }
     
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
