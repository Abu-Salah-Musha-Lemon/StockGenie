@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-12">
		<div class="panel panel-success">
			<div class="panel-heading" style=" display:flex; justify-content:space-between; align-items:center">
				<h3 class="panel-title text-white">All Attendance</h3>
				<a class="panel-title fs-4" href="{{ URL::to('/take-attendance') }}">
					<i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
				</a>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-12">
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SR</th>
										<th>Attend Date</th>
										<th>Action</th>
									</tr>
								</thead>
								@php $sr = 1; @endphp
								<tbody>
									@foreach($date as $row)
									<tr>
										<td>{{ $sr++ }}</td>
										<td>{{ $row->edit_date }}</td>
										<td>
											<a href="{{ URL::to('/edit-attendance/'.$row->edit_date) }}"
												class="btn btn-sm btn-info btn-custom waves-effect waves-light m-b-5 p-b-0"><i
													class="bi bi-pencil-square"></i></a>
											<a href="{{ URL::to('/delete-attendance/'.$row->edit_date) }}"
												class="btn btn-sm btn-danger btn-custom waves-effect waves-light m-b-5 p-b-0"><i
													class="bi bi-trash3"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection