@extends('layouts.layout')

@section('title', 'Create Invoice')

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
							<label class="form-control-label">Customer Name: <span class="tx-danger">*</span></label>
							<select class="form-control select2" data-placeholder="Select existing customer" name="customerid">
								<option label="Choose one"></option>
								@foreach($customers as $customer)
									<option value="{{ $customer->id }}">{{ $customer->firstname . ' ' . $customer->lastname }}</option>
								@endforeach
							</select>
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-6">
						<div class="form-group mg-t-40">
							<label class="ckbox">
			                  <input type="checkbox" name="newCustomer"><span>New Customer</span>
			                </label>
						</div>
					</div>
					<div class="new-customer d-none col-lg-12">					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Customer Name: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="sellquantity" placeholder="Customer Name" value="{{ old('sellquantity') }}">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-6">
								<div class="form-group">
									<label class="form-control-label">Customer Email: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="sellquantity" placeholder="Customer Email" value="{{ old('sellquantity') }}">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-12">
								<div class="form-group">
									<label class="form-control-label">Customer Phone: <span class="tx-danger">*</span></label>
									<input class="form-control" type="text" name="sellquantity" placeholder="Customer Phone" value="{{ old('sellquantity') }}">
								</div>
							</div><!-- col-4 -->
							<div class="col-lg-12">
								<div class="form-group mg-b-10-force">
									<label class="form-control-label">Customer Address:</label>
									<textarea name="note" class="form-control" placeholder="Customer Address">{{ old('note') }}</textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<table class="table">
							<thead>
								<tr class="item-row">
									<th>Item</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<tr class="item-row">
									<td><select class="form-control custom-select" id="product" name="product[]"><option label="Choose one"></option> @foreach($products as $product) <option value="{{ $product->id }}" price="{{ $product->sellprice }}" stock="{{ $product->stock }}">{{ $product->productname }}</option>@endforeach</select></td>
									<td><input class="form-control price" placeholder="Price" type="text"></td>
									<td><input class="form-control qty" placeholder="Quantity" type="text"></td>
									<td><span class="total">0.00</span></td>
								</tr>																
								<tr id="hiderow">
									<td colspan="4">
										<a id="addRow" href="javascript:;" title="Add a row" class="btn btn-primary">Add Product</a>
									</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td class="text-right"><strong>Sub Total</strong></td>
									<td><span id="subtotal">0.00</span></td>
								</tr>
								<tr>
									<td><strong>Total Quantity: </strong><span id="totalQty" style="color: red; font-weight: bold">0</span> Units</td>
									<td></td>
									<td class="text-right"><strong>Discount</strong></td>
									<td><input class="form-control" id="discount" value="0" type="text"></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td class="text-right"><strong>Shipping</strong></td>
									<td><input class="form-control" id="shipping" value="0" type="text"></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td class="text-right"><strong>Grand Total</strong></td>
									<td><span id="grandTotal">0</span></td>
								</tr>
							</tbody>
						</table>
						<div id="testproduct">
							
						</div>
					</div>

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