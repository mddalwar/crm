@extends('layouts.layout')

@section('title', 'Add Customer')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ route('customers.index') }}">Customers</a>
      <span class="breadcrumb-item active">Add Customer</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Add New Customer</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('customer_created'))
      		<div class="alert alert-success">{{ Session::get('customer_created') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('customers.store') }}" method="POST">
	        	@csrf
				<div class="row mg-b-25">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="firstname" placeholder="Enter firstname" value="{{ old('firstname') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="lastname" placeholder="Enter lastname" value="{{ old('lastname') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Email: </label>
							<input class="form-control" type="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Mobile Number: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Customer Address: <span class="tx-danger">*</span></label>
							<textarea name="address" class="form-control" placeholder="Customer Address">{{ old('address') }}</textarea>
						</div>
					</div><!-- col-4 -->
				</div><!-- row -->	          
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Add Customer</button>
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