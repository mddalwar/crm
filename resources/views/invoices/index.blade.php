@extends('layouts.layout')

@section('title')
<title>All Customers - Customer Relation Managment System</title>
@endsection

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="sh-breadcrumb">
	<nav class="breadcrumb">
	  <a class="breadcrumb-item" href="{{ url('/') }}">Dashboard</a>
	  <span class="breadcrumb-item active">Invoices</span>
	</nav>
</div><!-- sh-breadcrumb -->

<div class="sh-pagebody">

	<div class="card bd-primary mg-t-20">
	  <div class="card-header bg-primary tx-white">Invoices</div>
	  <div class="card-body pd-sm-30">
	  	@if(Session::has('deleted'))
      		<div class="alert alert-success">{{ Session::get('deleted') }}</div>
      	@endif
	    <div class="table-wrapper">
	      <table id="datatable1" class="table display responsive nowrap">
	        <thead>
	          <tr>
	            <th class="wd-10p">ID</th>
	            <th class="wd-20p">Product Name</th>
	            <th class="wd-20p">Customer Name</th>
	            <th class="wd-15p">Quantity</th>
	            <th class="wd-15p">Create date</th>
	            <th class="wd-20p">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach($invoices as $invoice)
	        	@php
	        		$product_infos = $users = DB::table('products')->where('id', [$invoice->productid])->get();
	        		$customer_infos = $users = DB::table('customers')->where('id', [$invoice->customerid])->get();
	        	@endphp
	        
	        	@foreach($product_infos as $product_info)
		        	@foreach($customer_infos as $customer_info)
					<tr>
						<td>{{ $invoice->id }}</td>
						<td>{{ $product_info->productname }}</td>
						<td>{{ $customer_info->firstname . ' ' . $customer_info->lastname }}</td>
						<td>{{ $invoice->sellquantity . ' ' . $product_info->unit }}</td>
						<td>{{ $invoice->created_at }}</td>
						<td>
							<a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-primary p-1">View</a>
							<a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-secondary p-1">Edit</a>
							<form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Do you really want to delete?');">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger p-1" type="submit">Delete</button>
							</form>
						</td>
					</tr>
		          @endforeach
	          @endforeach
	        @endforeach       
	        </tbody>
	      </table>
	    </div><!-- table-wrapper -->
	  </div><!-- card-body -->
	</div><!-- card -->

</div><!-- sh-pagebody -->

@endsection

@section('scripts')
<script src="{{ asset('public/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('public/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('public/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('public/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('public/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('public/lib/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('public/lib/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('public/js/shamcey.js') }}"></script>
<script>
  $(function() {
    'use strict';

    $('#datatable1').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      }
    });

    $('#datatable2').DataTable({
      bLengthChange: false,
      searching: false,
      responsive: true
    });

    // Select2
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  });
</script>
@endsection