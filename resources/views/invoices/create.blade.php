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
					@php
						$product_count = 1;
					@endphp
					<div class="col-lg-12">
						<table class="products">
							<tr id="product_{{ $product_count }}">
						       <td class="w-50">
						          <select class="form-control custom-select product" name="product">
					                <option label="Choose one"></option>
					                @foreach($products as $product)
					                  <option value="{{ $product->id }}" price="{{ $product->sellprice }}" stock="{{ $product->stock }}">{{ $product->productname }}</option>
					                @endforeach
					              </select>
						       </td>         
						       <td>
						          <input type="text" name="quantity" class="form-control" placeholder="Quantity">
						       </td>         
						       <td>
						          <input type="text" name="unit_price" class="form-control" placeholder="Unit Price">
						       </td>
						       <td>
						          <input type="text" name="total" class="form-control" placeholder="Total">
						       </td>
						       <td>
						          <span class="text-danger productremove" onclick="$('#product_{{ $product_count }}').remove();">Remove</span>
						       </td>
						    </tr>
						</table>
					</div>
					<div class="addproduct m-3 text-primary">Add Product</div>

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

    var newCustomer = $('input[name="newCustomer"]'),
    	newCustomerChecked = newCustomer.is(':checked');

    $(newCustomer).on('change', function(){
    	if(newCustomer.is(':checked')){
    		$('.new-customer').removeClass('d-none');
    	}else{
    		$('.new-customer').addClass('d-none');
    	}
    });

    var sl = {{ $product_count }};

	function addproduct(){
	    sl++;
	    var product = "";
	    product += '<tr id="product_'+sl+'">';
	    product +='<td class="w-50">';
	    product +='<select class="form-control custom-select product" name="product"><option label="Choose one"></option> @foreach($products as $product) <option value="{{ $product->id }}" price="{{ $product->sellprice }}" stock="{{ $product->stock }}">{{ $product->productname }}</option>@endforeach</select>';
	    product +='</td>';
	    product +='<td>';
	    product +='<input type="text" name="quantity" class="form-control" placeholder="Quantity">';
	    product +='</td>';         
	    product +='<td>';
	    product +='<input type="text" name="unit_price" class="form-control" placeholder="Unit Price">';
	    product +='</td>';
	    product +='<td>';
	    product +='<input type="text" name="total" class="form-control" placeholder="Total">';
	    product +='</td>';
	    product +='<td>';
	    product +='<span class="text-danger productremove" onclick="$(\'#product_'+sl+'\').remove();">Remove</span>';
	    product +='</td>';
	    product +='</tr>';

	    $('.products').append(product);
	}
    
    $('.addproduct').on('click', function(){
    	addproduct();
    });

    $('select[name="product"]').on('click', function(){
    	var product = $(this),
    		price = product.val();
    	product.parent().next('td').next('td').children('input').val(price);
    });

  });
</script>
@endsection