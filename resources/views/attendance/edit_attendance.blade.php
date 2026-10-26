@extends('layouts.layout')

@section('main')
<style>
    label {
        width: auto;
    }
</style>

<div class="row justify-content-center align-items-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-8 col-xl-6 col-xxl-6">
        <div class="panel panel-info">
            <div class="panel-heading" style="display:flex; justify-content:space-between; align-items:center">
                <h3 class="panel-title">Edit Attendance</h3>
                @if($data->count() > 0)
                    <span class='text-white'>{{ $data->first()->edit_date }}</span>
                @endif
                <a class="panel-title fs-4" href="{{ URL::to('/all-attendance') }}">
                    <i class="bi bi-box-arrow-in-left" style="font-size:24px;color:white;"></i>
                </a>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <form action="{{ URL::to('update-attendance') }}" method="post">
                        @csrf
                        <table id="dataTable" class="table table-striped table-bordered">
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
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->edit_date }}</td>
                                    <td>
                                        <img src="{{ URL::to($row->photo) }}" style="width:50px;height:50px;object-fit:cover;">
                                    </td>
                                    <td>
                                        <div>
                                            <input type="radio" name="attendance[{{ $row->id }}]" value="Present" @if($row->attendance == 'Present') checked @endif required> Present <br>
                                            <input type="radio" name="attendance[{{ $row->id }}]" value="Absent" @if($row->attendance == 'Absent') checked @endif required> Absent
                                        </div>
                                        <input type="hidden" name="id[]" value="{{ $row->id }}">
                                        <input type="hidden" name="att_time" value="{{ now()->format('H:i:s')}}">
                                        <input type="hidden" name="att_date" value="{{ $row->edit_date }}">
                                        <input type="hidden" name="att_year" value="{{ $row->att_year }}">
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
