@extends('layouts.dashboard')

@section('title', 'Add Expense')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ route('expenses.index') }}">Expenses</a>
      <span class="breadcrumb-item active">Add Expense</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Add Expense</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('success'))
      		<div class="alert alert-success">{{ Session::get('success') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('expenses.store') }}" method="POST">
	        	@csrf	        	
				<div class="row mg-b-25">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Expense Title: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="title" placeholder="Expense Title">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Expense Amount: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="amount" placeholder="Expense Amount">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Consumer Name: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="consumer" placeholder="Consumer Name">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Reference:</label>
							<input class="form-control" type="text" name="reference" placeholder="Reference">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-12">
						<div class="form-group">
							<label for="note">Note</label>
							<textarea name="note" id="note" class="form-control" placeholder="Write something about expense"></textarea>
						</div>
					</div>
				</div><!-- row -->	          
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Add Expense</button>
				</div><!-- form-layout-footer -->
	        </form>

        </div><!-- form-layout -->
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
<script src="{{ asset('public/lib/moment/moment.js') }}"></script>
<script src="{{ asset('public/lib/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('public/lib/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('public/lib/flot-spline/jquery.flot.spline.js') }}"></script>

<script src="{{ asset('public/js/shamcey.js') }}"></script>
<script src="{{ asset('public/js/dashboard.js') }}"></script>
@endsection