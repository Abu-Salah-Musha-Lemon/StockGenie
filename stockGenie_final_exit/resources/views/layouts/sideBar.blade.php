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
        <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{URL::to('dashboard')}}" class="waves-effect">
                <i class="ion-arrow-graph-up-right"></i>
                <span> Dashboard </span>
            </a>
        </li>

        <li class="{{ request()->routeIs('pos') ? 'active' : '' }}">
            <a href="{{route('pos')}}" class="waves-effect">
                <i class="ion-cash"></i>
                <span> POS </span>
            </a>
        </li>

        <li class="has_sub {{ request()->is('pendingOrder') || request()->is('paidOrder') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="md md-add-shopping-cart"></i>
                <span> Order </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('pendingOrder') ? 'active' : '' }}">
                    <a href="{{route('pendingOrder')}}">Pending Order</a>
                </li>
                <li class="{{ request()->routeIs('paidOrder') ? 'active' : '' }}">
                    <a href="{{route('paidOrder')}}">All Order Report</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('allSalesReport') || request()->is('todaySalesReport') || request()->is('monthlySalesReport') || request()->is('yearlySalesReport') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="fa fa-bar-chart-o"></i>
                <span> Sales Report </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('allSalesReport') ? 'active' : '' }}">
                    <a href="{{route('allSalesReport')}}">All Sales Report</a>
                </li>
                <li class="{{ request()->routeIs('todaySalesReport') ? 'active' : '' }}">
                    <a href="{{route('todaySalesReport')}}">Today Sales Report</a>
                </li>
                <li class="{{ request()->routeIs('monthlySalesReport') ? 'active' : '' }}">
                    <a href="{{route('monthlySalesReport')}}">Monthly Sales Report</a>
                </li>
                <li class="{{ request()->routeIs('yearlySalesReport') ? 'active' : '' }}">
                    <a href="{{route('yearlySalesReport')}}">Yearly Sales Report</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('employee.add-employee') || request()->is('employee.all-employee') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="bi bi-people"></i>
                <span> Employee </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('employee.add-employee') ? 'active' : '' }}">
                    <a href="{{route('employee.add-employee')}}">Add Employee</a>
                </li>
                <li class="{{ request()->routeIs('employee.all-employee') ? 'active' : '' }}">
                    <a href="{{route('employee.all-employee')}}">All Employee</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('category.index') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="bi bi-journal-richtext"></i>
                <span> Category</span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">Category</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('addProduct') || request()->is('allProduct') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="bi bi-basket"></i>
                <span> Product </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('addProduct') ? 'active' : '' }}">
                    <a href="{{route('addProduct')}}">Add Product</a>
                </li>
                <li class="{{ request()->routeIs('allProduct') ? 'active' : '' }}">
                    <a href="{{route('allProduct')}}">All Products</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('supplier.all-supplier') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="fa fa-truck"></i>
                <span> Supplier </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('supplier.all-supplier') ? 'active' : '' }}">
                    <a href="{{route('supplier.all-supplier')}}">All Suppliers</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('addExpense') || request()->is('todayExpense') || request()->is('monthlyExpense') || request()->is('yearlyExpense') || request()->is('allExpense') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="md md-attach-money"></i> 💸<span> Expense </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('addExpense') ? 'active' : '' }}">
                    <a href="{{route('addExpense')}}">Add Expense</a>
                </li>
                <li class="{{ request()->routeIs('todayExpense') ? 'active' : '' }}">
                    <a href="{{route('todayExpense')}}">Today Expense</a>
                </li>
                <li class="{{ request()->routeIs('monthlyExpense') ? 'active' : '' }}">
                    <a href="{{route('monthlyExpense')}}">Monthly Expense</a>
                </li>
                <li class="{{ request()->routeIs('yearlyExpense') ? 'active' : '' }}">
                    <a href="{{route('yearlyExpense')}}">Yearly Expense</a>
                </li>
                <li class="{{ request()->routeIs('allExpense') ? 'active' : '' }}">
                    <a href="{{route('allExpense')}}">All Expense</a>
                </li>
            </ul>
        </li>

        <li class="has_sub {{ request()->is('takeAttendance') || request()->is('allAttendance') ? 'active' : '' }}">
            <a href="#" class="waves-effect">
                <i class="fa fa-clock-o"></i>
                <span> Attendance </span>
                <span class="pull-right"><i class="md md-add"></i></span>
            </a>
            <ul class="list-unstyled">
                <li class="{{ request()->routeIs('takeAttendance') ? 'active' : '' }}">
                    <a href="{{route('takeAttendance')}}">Take Attendance</a>
                </li>
                <li class="{{ request()->routeIs('allAttendance') ? 'active' : '' }}">
                    <a href="{{route('allAttendance')}}">All Attendance</a>
                </li>
            </ul>
        </li>
    </ul>
</div>


