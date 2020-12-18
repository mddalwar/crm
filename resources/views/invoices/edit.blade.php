@extends('layouts.layout')

@section('title', 'Update Invoice')

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
      <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
      <a class="breadcrumb-item" href="{{ route('invoices.index') }}">Invoices</a>
      <span class="breadcrumb-item active">Edit Invoice</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Edit Invoice</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('invoice_updated'))
      		<div class="alert alert-success">{{ Session::get('invoice_updated') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route( 'invoices.update', $invoice->id ) }}" method="POST">
	        	@csrf
	        	@method('PUT')  	
				<div class="row mg-b-25">
					<div class="col-lg-6 mg-t-20 mg-lg-t-0">
						<div class="form-group products">
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
						<div class="form-group customers">
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
							<input class="form-control" type="number" name="sellquantity" placeholder="Sell Quantity" min="1" value="{{ $invoice->sellquantity }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group">
							<label class="form-control-label">Total Amount: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="totalamount" placeholder="Total Amount" value="{{ $invoice->totalamount }}" readonly="readonly">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Discount: </label>
							<input class="form-control" type="number" name="discount" placeholder="Discount" min="0" value="{{ $invoice->discount }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Paid:</label>
							<input class="form-control" type="number" name="paid" placeholder="Paid" min="0" value="{{ $invoice->paid }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Payment Type:</label>
							<select class="form-control custom-select" name="payment">
								<option label="Payment Type"></option>
								<option value="Bkash">Bkash</option>
								<option value="Rocket">Rocket</option>
								<option value="Cash">Cash</option>
								<option value="Bank Check">Bank Check</option>
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Invoice Note:</label>
							<textarea name="note" class="form-control" placeholder="Invoice Note">{{ $invoice->note }}</textarea>
						</div>
						<h6 class="card-body-title">Total Payable: Tk.<span class="payable">{{ $invoice->totalamount - $invoice->discount }}</span>/- , <span class="text-danger">Total Due: Tk.<span class="due">{{ $invoice->due }}</span>/-</span></h6>
					</div><!-- col-4 -->
				</div><!-- row -->	        
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Update Invoice</button>
				</div><!-- form-layout-footer -->
	        </form>

        </div><!-- form-layout -->
      </div><!-- card-body -->
    </div><!-- card -->

  </div><!-- sh-pagebody -->
  <div class="d-none productid">{{ $invoice->productid }}</div>
  <div class="d-none customerid">{{ $invoice->customerid }}</div>
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

    // Select2 by showing the search
    $('.select2').select2({
      minimumResultsForSearch: ''
    });

    var productid = $('.productid').text();
    var customerid = $('.customerid').text();

    // Keep selected product option
    $( "select[name='productid'] option[value='" + productid + "']" ).attr('selected', 'selected');
    var productname = $( "select[name='productid'] option[value='" + productid + "']" ).text();
    $(".products .select2-selection__rendered").text(productname).attr("title", productname);

    // Keep selected customer option
    $( "select[name='customerid'] option[value='" + customerid + "']" ).attr('selected', 'selected');
    var customername = $( "select[name='customerid'] option[value='" + customerid + "']" ).text();
    $(".customers .select2-selection__rendered").text(customername).attr("title", customername);

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