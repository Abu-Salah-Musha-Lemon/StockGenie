<style>
	.active > a {
    /* background-color: #CFF4D2; Example: green background for active items */
    background-color: #E0ECDE; /* Example: green background for active items */
    color: white!implements; /* Example: white text for active items */
    color: ;
}

.active > a .pull-right i {
    transform: rotate(90deg); /* Example: rotate the icon if the item is active */
}

</style>



<div id="sidebar-menu">
<ul>
	<li>
		<a href="{{route('dashboard')}}" class="waves-effect"><i class="ion-arrow-graph-up-right"></i><span> Dashboard
			</span></a>
	</li>

	<li>
		<a href="{{route('pos.sales.index')}}" class="waves-effect"><i class="ion-cash"></i><span> POS </span></a>
	</li>


	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="md md-add-shopping-cart"></i> <span> Order </span> <span
				class="pull-right"><i class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('pos.orders.pending')}}">Pending Order</a></li>
			<li><a href="{{route('pos.orders.paid')}}">All Order Report</a></li>

		</ul>
	</li>
	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="fa fa-bar-chart-o"></i> <span> Sales Report </span> <span
				class="pull-right"><i class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li class="active"><a href="{{route('reports.sales.index')}}">All Sales Report</a></li>
			<li><a href="{{route('reports.sales.today')}}">Today Sales Report</a></li>
			<li><a href="{{route('reports.sales.monthly')}}">Monthly Sales Report</a></li>
			<li><a href="{{route('reports.sales.yearly')}}">Yearly Sales Report</a></li>

		</ul>
	</li>
	
	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-people"></i> <span> Employee </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li class="active"><a href="{{route('admin.departments.index')}}">Departments</a></li>
			<li class="active"><a href="{{route('admin.employees.create')}}">Add Employee</a></li>
			<li><a href="{{route('admin.employees.index')}}">All Employee</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-journal-richtext"></i> <span> Category</span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{ route('admin.categories.index') }}">Category</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="bi bi-basket"></i> <span> Product </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('admin.products.create')}}">Add Product</a></li>
			<li class="active"><a href="{{route('admin.products.index')}}">All Products</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="fa fa-truck"></i> <span> Supplier </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('admin.suppliers.index')}}">All Suppliers</a></li>
		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="md md-attach-money"></i> 💸<span> Expense </span> <span
				class="pull-right"><i class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('admin.expenses.create')}}">Add Expense</a></li>
			<li class="active"><a href="{{route('admin.expenses.index')}}">All Expense</a></li>

		</ul>
	</li>

	<li class="has_sub">
		<a href="#" class="waves-effect"><i class="fa fa-clock-o"></i> <span> Attendance </span> <span class="pull-right"><i
					class="md md-add"></i></span></a>
		<ul class="list-unstyled">
			<li><a href="{{route('admin.attendance.create')}}">Take Attendance</a></li>
			<li><a href="{{route('admin.attendance.index')}}">All Attendance</a></li>


		</ul>
	</li>

</ul>
</div>