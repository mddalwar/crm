@extends('layouts.dashboard')

@section('title', 'Settings')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/') }}">Dashboard</a>
      <span class="breadcrumb-item active">Settings</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Change Settings</div>
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
	        <form action="{{ route('settings.update') }}" method="POST">
	        	@csrf 	
				<div class="row mg-b-25">
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Shop Name: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="shopname" placeholder="Shop Name" value="{{ settings()->shopname }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Phone Number: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="phone" placeholder="Phone Number" value="{{ settings()->phone }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Email:</label>
							<input class="form-control" type="text" name="email" placeholder="Enter email" value="{{ settings()->email }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Logo Text: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="logotext"  placeholder="Logo Text" value="{{ settings()->logotext }}">
						</div>
					</div><!-- col-8 -->
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Copyright Text: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="copyright"  placeholder="Copyright Text" value="{{ settings()->copyright }}">
						</div>
					</div><!-- col-8 -->
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Address: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="address"  placeholder="Address" value="{{ settings()->address }}">
						</div>
					</div><!-- col-8 -->
				</div><!-- row -->
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Save Settings</button>
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