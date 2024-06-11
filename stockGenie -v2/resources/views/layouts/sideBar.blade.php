<ul>
	<li>
		<a href="{{URL::to('dashboard')}}" class="waves-effect"><i class="ion-arrow-graph-up-right"></i><span> Dashboard
			</span></a>
	</li>

	<li>
		<a href="{{route('pos')}}" class="waves-effect"><i class="ion-cash"></i><span> POS </span></a>
	</li>


	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="md md-add-shopping-cart"></i> <span> Order </span> <span
				class="pull-right"><i class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('pendingOrder')}}">Pending Order</a></li>
			<li><a href="{{route('paidOrder')}}">All Order Report</a></li>

		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-people"></i> <span> Employee </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li class="active"><a href="{{ route('employees.index') }}">Employee</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-people"></i> <span> Categories </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{ route('categories.index') }}">Categories</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-basket"></i> <span> Product </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('addProduct')}}">Add Product</a></li>
			<li class="active"><a href="{{route('updateProductQtyView')}}">Add Products Qty</a></li>
			<li class="active"><a href="{{route('allProduct')}}">All Products</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-people"></i> <span> Supplier </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{ route('suppliers.index') }}">Supplier</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="md md-attach-money"></i> 💸<span> Expense </span> <span
				class="pull-right"><i class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('addExpense')}}">Add Expense</a></li>
			<li><a href="{{route('todayExpense')}}">Today Expense</a></li>
			<li><a href="{{route('monthlyExpense')}}">Monthly Expense</a></li>
			<li><a href="{{route('yearlyExpense')}}">Yearly Expense</a></li>
			<li class="active"><a href="{{route('allExpense')}}">All Expense</a></li>

		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="fa fa-clock-o"></i> <span> Attendance </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('takeAttendance')}}">Take Attendance</a></li>
			<li><a href="{{route('allAttendance')}}">All Attendance</a></li>


		</ul>
	</li>

</ul>