@extends('layouts.layout')

@section('title')
<title>Add Customer - Customer Relation Managment System</title>
@endsection

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
      <a class="breadcrumb-item" href="{{ route('customers.index') }}">Invoices</a>
      <span class="breadcrumb-item active">Create Invoice</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Create Invoice</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('invoice_created'))
      		<div class="alert alert-success">{{ Session::get('invoice_created') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('invoices.store') }}" method="POST">
	        	@csrf

				<div class="row mg-b-25">
					<div class="col-lg-6 mg-t-20 mg-lg-t-0">
						<div class="form-group">
							<label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
							<select class="form-control select2" data-placeholder="Select product from list" name="productid">
								<option label="Choose one"></option>
								@foreach($products as $product)
									<option value="{{ $product->id }}" price="{{ $product->sellprice }}">{{ $product->productname }}</option>
								@endforeach
							</select>
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6 mg-t-20 mg-lg-t-0">
						<div class="form-group">
							<label class="form-control-label">Customer Name: <span class="tx-danger">*</span></label>
							<select class="form-control select2" data-placeholder="Select customer from list" name="customerid">
								<option label="Choose one"></option>
								@foreach($customers as $customer)
									<option value="{{ $customer->id }}">{{ $customer->firstname . ' ' . $customer->lastname }}</option>
								@endforeach
							</select>
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Sell Quantity: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="sellquantity" placeholder="Sell Quantity" min="1" value="{{ old('sellquantity') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Total Amount: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="totalamount" placeholder="Total Amount" value="0" readonly="readonly">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Discount: </label>
							<input class="form-control" type="number" name="discount" placeholder="Discount" min="0" value="{{ old('discount') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Paid: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="paid" placeholder="Paid" min="0" value="{{ old('paid') }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Invoice Note:</label>
							<textarea name="note" class="form-control" placeholder="Invoice Note">{{ old('note') }}</textarea>
						</div>
						<h6 class="card-body-title">Total Payable: Tk.<span class="payable">0</span>/- , <span class="text-danger">Total Due: Tk.<span class="due">0</span>/-</span></h6>
					</div><!-- col-4 -->
				</div><!-- row -->				
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Create Invoice</button>
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

<script>
  $(function(){

    'use strict';

    //Select2 by showing the search
    $('.select2').select2({
      minimumResultsForSearch: ''
    });

    $('input[name="sellquantity"], select[name="productid"]').on('change', function(){
    	var sellprice 	= $( "select[name='productid'] option:selected" ).attr('price'),
    		sellqnty 	= $( "input[name='sellquantity']" ).val(),
    		totalprice 	= sellprice * sellqnty;

    	$('input[name="totalamount"]').val(totalprice);
    	$('input[name="paid"]').attr('max', totalprice);
    	$('input[name="discount"]').attr('max', totalprice);
    });

    $('input[name="paid"], input[name="sellquantity"], input[name="discount"], select[name="productid"]').on('change', function(){
    	var sellprice = $( "select[name='productid'] option:selected" ).attr('price'),
    		sellqnty = $( "input[name='sellquantity']" ).val(),
    		discount = $( "input[name='discount']" ).val(),
    		paid = $( "input[name='paid']" ).val(),
    		totalprice = sellprice * sellqnty - discount,
    		due = totalprice - paid;

    	$('span.payable').text(totalprice);
    	$('span.due').text(due);
    });

  });
</script>
@endsection