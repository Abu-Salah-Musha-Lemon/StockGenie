@extends('layouts.layout')
@section('main')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading" style="display: flex;justify-content: space-between;">
                <h3 class="panel-title text-white">Product buy History</h3>
                <a class="panel-title fs-4" href="{{ URL::to('/add-product') }}">
                    <i class="bi bi-bag-plus" style="font-size:24px;color:white;font-weight:800;"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr/No</th>
                                        <th>Sr/No</th>
                                        <th>Time</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Code</th>
                                        <th>Supplier Name</th>
                                        <th>Quantity</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $s= 0; @endphp
                                    @foreach($productQty as $row )
                                    <tr>
                                        <td>{{ $s+=1 }}</td>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->changed_at }}</td>
                                        <td>
                                            <img src="{{ asset($row->product_image) }}" style="width:50px;height:50px;object-fit:cover;">
                                        </td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ $row->product_code }}</td>
                                            <td>
                                            @if ($row->sup_id == $row->suppliers_id)  <!-- Make sure to use 'suppliers_id' -->
                                                {{ $row->supplier_name }}  <!-- Display the supplier name -->
                                            @else
                                                No matching supplier
                                            @endif
                                                                            
                                            </td>
                                            <td>  {{$row->quantity }}  </td>
                                            <td> {{ $row->buying_price }}  </td>
                                            <td> {{ $row->selling_price }}  </td>
                                       
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
        title: "Are you sure to delete this Product?",
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
        initializeDataTable(['Product Name', 'Code', 'Quantity', 'Selling Price', 'Garage', 'Route']);
    });
</script>
@endsection

@endsection
