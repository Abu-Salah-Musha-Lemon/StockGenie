@extends('layouts.layout')
@section('main')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-success">

			<div class="panel-heading " style="display: flex;justify-content: space-between;">
				<h3 class="panel-title text-white">All Employees</h3>

				<div class="div" style="display: flex; justify-content: space-between;">
					<a class="panel-title fs-4" href="{{ URL::to('/add-employee') }}">
						<i class="bi bi-person-add" style="font-size:24px;color:white;font-weight:800;"></i>
					</a>

				</div>

			</div>
			<div class="panel-body">
				<div class="row">

					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="dataTable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>SR/N</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Address</th>
										<th>Image</th>
										<th>Salary</th>
										<th>Action</th>
									</tr>
								</thead>

								<tbody>
								@php $s = 0; @endphp
								@foreach($employees as $row)
    <tr>
        <td>{{ $s+=1 }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->phone }}</td>
        <td>{{ $row->address }}</td>
        <td class="ignore-row">
					<img src="{{ asset($row->photo) }}" style="width:50px;height:50px;object-fit:cover;">
        </td>
        <td>{{ $row->salary }}</td>
        <td class="ignore-row" style="display: flex; gap: 4px;">
            <!-- Edit button -->
            <a href="{{ route('edit-employee', ['id' => $row->id]) }}" class="btn btn-sm btn-info btn-custom waves-effect waves-light m-b-5 p-b-0">
                <i class="bi bi-pencil-square" style="font-size: 18px;"></i>
            </a>

            <!-- View button -->
            <a href="{{ route('view-employee', ['id' => $row->id]) }}" class="btn btn-sm btn-primary btn-custom waves-effect waves-light m-b-5 p-b-0">
                <i class="bi bi-cast" style="font-size: 18px;"></i>
            </a>

            <!-- Delete button only for role 1 -->
            @if($row->role == 1) 
                <a href="{{ route('delete-employee', ['id' => $row->id]) }}" class="btn btn-sm btn-danger btn-custom waves-effect waves-light m-b-5 p-b-0" onclick="confirmation(event)">
                    <i class="bi bi-trash3" style="font-size: 18px;"></i>
                </a>
            @endif
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
@section('script')
<script>
	 function confirmation(ev) {
    ev.preventDefault();  // Prevent the default link behavior
    var urlToRedirect = ev.currentTarget.getAttribute('href');  
    console.log(urlToRedirect); 

    swal({
        title: "Are you sure to delete this Employee?",
        text: "You will not be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // Redirect if confirmed
            window.location.href = urlToRedirect;
        }
    });
}
    $(document).ready(function () {
        initializeDataTable(['Name', 'Phone', 'Salary', 'Salary']);
    });
    </script>
@endsection

@endsection