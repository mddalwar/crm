@extends('layouts.layout')

@section('title', 'Create Collection')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/spectrum/spectrum.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="sh-breadcrumb">
    <nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ route('collections.index') }}">Collections</a>
      <span class="breadcrumb-item active">Create Collection</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Create Collection</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('faild'))
      		<div class="alert alert-danger">{{ Session::get('faild') }}</div>
      	@endif

      	@if(Session::has('success'))
      		<div class="alert alert-success">{{ Session::get('success') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('collections.store') }}" method="POST">
	        	@csrf

				<div class="row mg-b-25">
					<div class="col-lg-8 mg-t-20 mg-lg-t-0">
						<div class="form-group">
							<label class="form-control-label">Customer: <span class="tx-danger x-customer">*</span></label>
							<select class="form-control select2" data-placeholder="Select customer" name="customer">
								<option label="Choose one"></option>
								@foreach(customers() as $customer)
									<option value="{{ $customer->id }}">{{ $customer->customername . ', ' . $customer->address }}</option>
								@endforeach
							</select>
						</div>
					</div><!-- col-4 -->
					
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Amount: <span class="tx-danger x-customer">*</span></label>
							<input type="text" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="Collection Amount">
						</div>
					</div>

					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Collection Note:</label>
							<textarea name="note" class="form-control" placeholder="Collection Note">{{ old('note') }}</textarea>
						</div>
					</div><!-- col-4 -->
				</div><!-- row -->				
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Create Collection</button>
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
<script src="{{ asset('public/lib/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('public/lib/spectrum/spectrum.js') }}"></script>
<script src="{{ asset('public/js/shamcey.js') }}"></script>
<script src="{{ asset('public/js/invoice.js') }}"></script>

<script>
  $(function(){

    'use strict';
    //Select2 by showing the search
    $('.select2').select2({
      minimumResultsForSearch: ''
    });

  });
</script>
@endsection