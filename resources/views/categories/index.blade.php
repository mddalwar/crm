@extends('layouts.dashboard')

@section('title', 'All Category')

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
	  <span class="breadcrumb-item active">Categories</span>
	</nav>
</div><!-- sh-breadcrumb -->

<div class="sh-pagebody">

	<div class="card bd-primary mg-t-20">
	  <div class="card-header bg-primary tx-white">Categories</div>
	  <div class="card-body pd-sm-30">
	  	@if(Session::has('success'))
      		<div class="alert alert-success">{{ Session::get('success') }}</div>
      	@endif
	    <div class="table-wrapper">
	      <table id="datatable1" class="table display responsive nowrap">
	        <thead>
	          <tr>
	            <th class="wd-5p">ID</th>
	            <th class="wd-15p">Category Name</th>
	            <th class="wd-15p">Total Product</th>
	            <th class="wd-20p">Created By</th>
	            <th class="wd-20p">Create Date</th>
	            <th class="wd-15p">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach($categories as $category)
	          <tr>
	            <td>{{ $category->id }}</td>
	            <td>{{ $category->name }}</td>
	            <td>{{ count($category->products) . ' Nos' }}</td>
	            <td>{{ $category->created_by->firstname . ' ' . $category->created_by->lastname }}</td>
	            <td>{{ $category->created_at->format('F j, Y')}}</td>
	            <td>
	            	<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary p-1">Edit</a>
	            	<form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Do you really want to delete?');">
	            		@csrf
	            		@method('DELETE')
	            		<button class="btn btn-danger p-1" type="submit">Delete</button>
	            	</form>
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