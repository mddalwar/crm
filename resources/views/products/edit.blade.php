@extends('layouts.layout')

@section('title')
<title>Update Product - Customer Relation Managment System</title>
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
      <a class="breadcrumb-item" href="{{ route('products.index') }}">Products</a>
      <span class="breadcrumb-item active">Update Product</span>
    </nav>
  </div><!-- sh-breadcrumb -->

  <div class="sh-pagebody">

    <div class="card bd-primary mg-t-20">
      <div class="card-header bg-primary tx-white">Update Product</div>
      <div class="card-body pd-sm-30">
      	@if(isset($errors))
      		@foreach($errors->all() as $error)
      			<div class="alert alert-danger">{{ $error }}</div>
      		@endforeach
      	@endif

      	@if(Session::has('product_updated'))
      		<div class="alert alert-success">{{ Session::get('product_updated') }}</div>
      	@endif
        <div class="form-layout">
	        <form action="{{ route('products.update', $product->id ) }}" method="POST">
	        	@csrf
	        	@method('PUT')
				<div class="row mg-b-25">
					<div class="col-lg-8">
						<div class="form-group">
							<label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
							<input class="form-control" type="text" name="productname" placeholder="Product Name" value="{{ $product->productname }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Primary Stock: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="stock" placeholder="Primary Stock" value="{{ $product->stock }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Unit: <span class="tx-danger">*</span></label>
							<select class="form-control custom-select" name="unit">
								<option label="Product Unit"></option>
								<option value="Packet" @if($product->unit == 'Packet') selected='selected' @endif>Packet</option>
								<option value="Pcs" @if($product->unit == 'Pcs') selected='selected' @endif>Pcs</option>
								<option value="Dozon" @if($product->unit == 'Dozon') selected='selected' @endif>Dozon</option>
								<option value="Kg" @if($product->unit == 'Kg') selected='selected' @endif>Kg</option>
								<option value="Litter" @if($product->unit == 'Litter') selected='selected' @endif>Litter</option>
							</select>
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Purchase Price: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="purchaseprice" placeholder="Purchase Price" value="{{ $product->purchaseprice }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-4">
						<div class="form-group">
							<label class="form-control-label">Sell Price: <span class="tx-danger">*</span></label>
							<input class="form-control" type="number" name="sellprice" placeholder="Unit Price" value="{{ $product->sellprice }}">
						</div>
					</div><!-- col-4 -->
					<div class="col-lg-12">
						<div class="form-group mg-b-10-force">
							<label class="form-control-label">Product Description:</label>
							<textarea name="description" class="form-control" placeholder="Product Description">{{ $product->description }}</textarea>
						</div>
					</div><!-- col-4 -->
				</div><!-- row -->	          
				<div class="form-layout-footer">
					<button class="btn btn-primary mg-r-5" type="submit">Update Product</button>
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