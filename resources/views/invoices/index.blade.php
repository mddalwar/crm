@extends('layouts.dashboard')

@section('title', 'All Invoices')

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
	  <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
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
	            <th class="wd-20p">Customer Name</th>
	            <th class="wd-15p">Purchased</th>
	            <th class="wd-15p">Create date</th>
	            <th class="wd-15p">Total Bill</th>
	            <th class="wd-15p">Created By</th>
	            <th class="wd-20p">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach($invoices as $invoice)
				<tr>
					<td>{{ 'INV-' . $invoice->id }}</td>
					<td>{{ $invoice->customer->name }}</td>
					<td>{{ count($invoice->products) . ' Products'}}</td>
					<td>{{ $invoice->created_at->format('F j, Y') }}</td>
					<td>{{ $invoice->total . ' ' . settings()->currency }}</td>
					<td>{{ $invoice->created_by->firstname . ' ' . $invoice->created_by->lastname }}</td>
					<td>
						<a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-primary p-1">View</a>
						
					</td>
				</tr>
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