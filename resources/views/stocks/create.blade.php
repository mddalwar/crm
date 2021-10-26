@extends('layouts.dashboard')

@section('title', 'Add Stock')

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
      <a class="breadcrumb-item" href="{{ route('stocks.index') }}">Stocks</a>
      <span class="breadcrumb-item active">Add Stock</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Add Stock</div>
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
	        <form action="{{ route('stocks.store') }}" method="POST">
	        	@csrf
	        	
				<div class="row mg-b-25">
					<div class="col-lg-6 mg-t-20 mg-lg-t-0">
						<div class="form-group">
							<label class="form-control-label">Product: <span class="tx-danger">*</span></label>
							<select class="form-control select2" data-placeholder="Select a product" name="product_id">
								<option label="Choose one"></option>
								@foreach(products() as $product)
									<option value="{{ $product->id }}">{{ $product->name }}</option>
								@endforeach
							</select>
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-3">
						<div class="form-group">
							<label for="stock" class="form-control-label">Stock Amount <span class="tx-danger">*</span></label>
							<input type="text" id="stock" name="stock" class="form-control" placeholder="Stock Amount" value="{{ old('stock') }}">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<label for="price" class="form-control-label">Unit Price <span class="tx-danger">*</span></label>
							<input type="text" id="price" name="price" class="form-control" placeholder="Unit Price" value="{{ old('price') }}">
						</div>
					</div>

					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Stock Note:</label>
							<textarea name="note" class="form-control" placeholder="Stock Note">{{ old('note') }}</textarea>
						</div>
					</div><!-- col-4 -->
				</div><!-- row -->				
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Add Stock</button>
				</div><!-- form-layout-footer -->
	        </form>

        </div><!-- form-layout -->
      </div><!-- card-body -->
    </div><!-- card -->
  </div><!-- sh-pagebody -->
  <div class="ajaxUrl d-none">{{ route('ajaxproducts') }}</div>
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


    var newCustomer = $('input[name="newCustomer"]'),
    	newCustomerChecked = newCustomer.is(':checked');

    $(newCustomer).on('change', function(){
    	if(newCustomer.is(':checked')){
    		$('.new-customer').removeClass('d-none');
    	}else{
    		$('.new-customer').addClass('d-none');
    	}
    });

	jQuery().invoice({
		addRow : "#addRow",
		delete : ".delete",
		parentClass : ".item-row",

		price : ".price",
		qty : ".qty",
		total : ".total",
		totalQty: "#totalQty",

		subtotal : "#subtotal",
		discount: "#discount",
		shipping : "#shipping",
		grandTotal : "#grandTotal"
	});

  });
</script>
@endsection