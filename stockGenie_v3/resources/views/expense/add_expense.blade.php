@extends('layouts.layout')
@section('main')

<style>
	label{
		width:auto;
	}
</style>


	<div class="row "style="display:flex;justify-content:center;align-item:center;">
					<!-- Basic example -->
		<div class=" col-md-6 col-lg-8 col-xl-10">
					<div class="panel panel-info">
							<div class="panel-heading " style="display: flex;justify-content: space-between;">
											<h3 class="panel-title">Add Expense</h3>
											<a class="panel-title fs-4" href="{{URL::to('/all-expense')}}">
													<i class="bi bi-box-arrow-in-left"style="font-size:24px"></i>
											</a>
							</div>
							<div class="panel-body">

							<form role="form" action="{{ URL::to('/insert-expense') }}" method="post" enctype="multipart/form-data">
								@csrf

								<div class="form-group">
										<label>Expense Details</label>
										<input type="text" class="form-control" name="details" placeholder="Enter Details">
								</div>
								<div class="form-group">
										<label>Expense Amount</label>
										<input type="text" class="form-control" name="amount" placeholder="Enter Amount">
								</div>
								<div class="form-group">
										
										<input type="hidden" class="form-control" name="date" value="{{date('d/m/y')}}">
								</div>
								<div class="form-group">
										<input type="hidden" class="form-control" name="month" value="{{date('F')}}">
								</div>
								<div class="form-group">
										<input type="hidden" class="form-control" name="year" value="{{date('Y')}}">
								</div>

								<button type="submit" class="btn btn-success">Submit</button>

						</form>


						</div><!-- panel-body -->
				</div> <!-- panel -->
		</div> <!-- col-->
	</div><!-- row  -->

@endsection