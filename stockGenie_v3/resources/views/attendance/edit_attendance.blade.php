@extends('layouts.layout')
@section('main')
<style>
    label{
        width:auto;
    }
</style>

        <div class="row"style="display:flex;justify-content:center;align-item:center;">
            <!-- Basic example -->
            <div class="col col-md-6  col-lg-12 col-xl-12  m-auto">
                <div class="panel panel-info">
                   
 
                <div class="panel-heading " style="display: flex;justify-content: space-between;">
                            <h3 class="panel-title">Edit attendance</h3>
                                <span class='text-white'>{{$date->edit_date}}</span>
                            <a class="panel-title fs-4" href="{{URL::to('/all-attendance')}}">
                                <i class="bi bi-box-arrow-in-left"style="font-size:24px;color:white;"></i>
                            </a>
                    </div>

                    <div class="panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <form action="{{URL::to('update-attendance')}}" method="post">
                        @csrf
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Photo</th>
                                                <th>Attendance Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            @foreach($data as $row)                             

                                            <tr>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->edit_date}}</td>
                                                <td><img src="{{URL::to($row->photo)}}"style="width:50px;height:50px;object:cover;"></td> 
                                                <td>
                                                    <input type="radio" name="attendance[{{$row->id}}]" value="Present"@php if($row->attendance=='Present')echo 'checked'; @endphp  required> Present <br>
                                                    <input type="radio" name="attendance[{{$row->id}}]" value="Absent"@php if($row->attendance=='Absent')echo 'checked'; @endphp  required> Absent <br>
                                                    <input type="hidden" name="id[]" value="{{$row->id}}">
                                                    <input type="hidden" name="att_date" value="{{date('d/m/y')}}">
                                                    <input type="hidden" name="att_year" value="{{date('Y')}}">
                                                </td>
                                            </tr>
                                              
                                            @endforeach
                                            
                                        </tbody>                                 
                                                
                           

                                    </table>
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Update</button>

                            
                        </form>
                                </div>

                    </div><!-- panel-body -->
                </div> <!-- panel -->
            </div> <!-- col-->
        </div>
@endsection