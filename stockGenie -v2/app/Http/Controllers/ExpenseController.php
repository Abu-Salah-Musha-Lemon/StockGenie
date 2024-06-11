<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view = DB::table('expenses')->get();
        return view('expense.all_expense',compact('view'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.add_expense');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = array();
       $data['details']=$request->details;
       $data['amount']=$request->amount;
       $data['date']=$request->date;
       $data['month']=$request->month;
       $data['year']=$request->year;
       $store = DB::table('expenses')->insert($data);
       if ($store) {
        // echo"<script>alert('add expenses successfully')</script>";
        $notification = array(
            'message' => 'Add Expense Successfully ',
            'alert-type' => 'success'
        );
        return redirect()->route('allExpense')->with($notification);
    }else {
        $notification = array(
            'message' => 'failed to add Expense ',
            'alert-type' => 'error'
        );
           return redirect()->route('allExpense')->with($notification);
        // echo"<script>alert('expenses did not add ')</script>";
       }
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
       
    }
    public function todayExpense() {
        $date= date("d/m/y");
        $today =DB::table('expenses')->where('date',$date)->get();
        return view('expense.today_expense',compact('today'));
    }
    public function monthlyExpense() {
        $month= date("F");
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthly_expense',compact('monthly'));
    }
    public function JanuaryExpense() {
        $month= "January";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function FebruaryExpense() {
        $month= "February";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function MarchExpense() {
        $month= "March";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function AprilExpense() {
        $month= "April";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function MayExpense() {
        $month= "May";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function JuneExpense() {
        $month= "June";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function JulyExpense() {
        $month= "July";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function AugustExpense() {
        $month= "August";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function SeptemberExpense() {
        $month= "September";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function OctoberExpense() {
        $month= "October";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function NovemberExpense() {
        $month= "November";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function DecemberExpense() {
        $month= "December";
        $monthly =DB::table('expenses')->where('month',$month)->get();
        return view('expense.monthSrl_expense',compact('monthly'));
    }
    public function yearlyExpense() {
        $year= date("Y");
        $yearly =DB::table('expenses')->where('year',$year)->get();
        return view('expense.yearly_expense',compact('yearly'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = DB::table('expenses')
                        ->where('id',$id)
                        ->first();
                        return view('expense.edit_expense',compact('edit'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = array();
       $data['details']=$request->details;
       $data['amount']=$request->amount;
    //    $data['day']=$request->day;
    //    $data['month']=$request->month;
    //    $data['year']=$request->year;
        $store = DB::table('expenses')->where('id',$id)->update($data);
        if ($store) {
            // echo"<script>alert('update expenses successfully')</script>";
            $notification = array(
                'message' => 'Update Expense Successfully ',
                'alert-type' => 'success'
            );
            return redirect()->route('allExpense')->with($notification);
        }else {
            $notification = array(
                'message' =>'Failed to update Expense',
                'alert-type' => 'error'
            );
               return redirect()->back()->with($notification);
            // echo"<script>alert('expenses did not update ')</script>";
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $delete = DB::table('expenses')->where('id',$id)->delete();
        if ($delete) {
            echo"<script>alert('Delete expenses successfully')</script>";
            return redirect()->route('allExpense');
           }else {
            echo"<script>alert('expenses did not Delete ')</script>";
           }
    }
}
