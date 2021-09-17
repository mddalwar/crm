@extends('layouts.dashboard')

@section('title', 'Deleted Roles')

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
		<span class="breadcrumb-item active">Deleted Roles</span>
	</nav>
</div><!-- sh-breadcrumb -->
<div class="sh-pagetitle">
	<div class="sh-pagetitle-left">
		<div class="sh-pagetitle-icon"><i class="icon ion-ios-home"></i></div>
		<div class="sh-pagetitle-title">
			<h2>Deleted Roles</h2>
		</div><!-- sh-pagetitle-left-title -->
	</div><!-- sh-pagetitle-left -->
</div><!-- sh-pagetitle -->

<div class="sh-pagebody">
	@if (Session::has('success'))      
	    <div class="alert alert-success">{{ Session::get('success') }}</div>   
	@endif
	<div class="card bd-primary mg-t-20">
		<div class="card-header bg-primary tx-white">Roles List</div>
			<div class="card-body pd-sm-30">
				<div class="table-wrapper">
				  <table id="datatable" class="table display responsive nowrap">
				    <thead>
				      <tr>
				        <th class="wd-10p">ID</th>
				        <th class="wd-20p">Role Name</th>
				        <th class="wd-15p">Total User</th>
				        <th class="wd-15p">Added Date</th>
				        @if( user_can('roleedit') || user_can('roledelete') )
				        <th class="wd-10p">Action</th>
				        @endif
				      </tr>
				    </thead>
				    <tbody>
				    @foreach($roles as $role)
				      <tr>
				        <td>{{ $role->id }}</td>
				        <td>{{ $role->name }}</td>
				        <td>{{ total_user_in_role($role->id) }}</td>
				        <td>{{ ostore_date($role->created_at) }}</td>
				        <td>
				        	@if( user_can('roleedit') )
				        	<a href="{{ route('roles.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
				        	@endif

				        	@if( user_can('roledelete') )
				        	<form class="d-inline-block" action="{{ route('roles.reactive', $role->id) }}" method="POST" onclick="return confirm('Really want to re-active?');">
				        	@csrf
				        		<button type="submit" class="text-danger border-0 bg-light"><i class="fa fa-trash"></i></button>
				        	</form>
				        	@endif
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

	    $('#datatable').DataTable({
	      responsive: true,
	      language: {
	        searchPlaceholder: 'Search...',
	        sSearch: '',
	        lengthMenu: '_MENU_ items/page',
	      }
	    });

	    // Select2
	    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

	});
</script>
@endsection