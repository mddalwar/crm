@extends('layouts.layout')

@section('title')
<title>New Invest - Customer Relation Managment System</title>
@endsection

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ route('invests.index') }}">All Invests</a>
      <span class="breadcrumb-item active">New Invest</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">New Invest</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('invest_edited'))
      		<div class="alert alert-success">{{ Session::get('invest_edited') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('invests.update', $invest->id) }}" method="POST">
	        	@csrf
	        	@method('PUT')        	
				<div class="row mg-b-25">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Invest By: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="investby" placeholder="Invest By" value="{{ $invest->investby }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Amount: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="amount" placeholder="Amount" value="{{ $invest->amount }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-12">
						<div class="form-group">
							<label for="note">Note</label>
							<textarea name="note" id="note" class="form-control" placeholder="Write something about invest">{{ $invest->note }}</textarea>
						</div>
					</div>
				</div><!-- row -->	          
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Edit Investment</button>
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