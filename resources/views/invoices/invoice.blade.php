@extends('layouts.dashboard')

@section('title', 'Single Invoice')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="sh-breadcrumb">
   	<nav class="breadcrumb">
      <a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
      <a class="breadcrumb-item" href="{{ route('invoices.index') }}">Invoices</a>
      <span class="breadcrumb-item active">Invoice</span>
    </nav>
</div><!-- sh-breadcrumb -->

<div class="sh-pagebody">

    <div class="card bd-primary">
      <div class="card-body pd-30 pd-md-60">
        <div class="d-md-flex justify-content-between flex-row-reverse">
          <h1 class="mg-b-0 tx-uppercase tx-gray-400 tx-mont tx-bold">Invoice</h1>
          <div class="mg-t-25 mg-md-t-0">

            <h6 class="tx-primary">{{ settings()->shopname }}</h6>
            <p class="lh-7">{{ settings()->address }}<br>
            Mobile: 0{{ settings()->phone }}<br>
            @if(!empty(settings()->email))
            Email: {{ settings()->email }}</p>
            @endif
          </div>
        </div><!-- d-flex -->

        <div class="row mg-t-20">
          <div class="col-md">
            <label class="tx-uppercase tx-13 tx-bold mg-b-20">Billed To:</label>
            <h6 class="tx-inverse">{{ $invoice->customer->name }}</h6>
            <p class="m-0">{{ $invoice->customer->address }}</p>
            @if(!empty($invoice->customer->email))
          	 <p class="m-0"><strong>Email: </strong>{{ $invoice->customer->email }}</p>
            @endif
            @if(!empty($invoice->customer->phone)) 
          	 <p class="m-0"><strong>Phone: </strong>{{ $invoice->customer->phone }}</p>
            @endif
          </div><!-- col -->
          <div class="col-md">
            <label class="tx-uppercase tx-13 tx-bold mg-b-20">Invoice Information:</label>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Invoice No:</span>
              <span>INV-{{ $invoice->id }}</span>
            </p>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Customer Due:</span>
              <span>{{ $invoice->customer->due }}</span>
            </p>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Create Date:</span>
              <span>{{ $invoice->created_at->format('F j, Y h:i:s A') }}</span>
            </p>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Created By:</span>
              <span>{{ $invoice->created_by->firstname . ' ' . $invoice->created_by->lastname }}</span>
            </p>
          </div><!-- col -->
        </div><!-- row -->

        <div class="table-responsive mg-t-40">
          <table class="table">
            <thead>
              <tr>
                <th class="wd-40p">Product Name</th>
                <th class="tx-center wd-20p">Quantity</th>
                <th class="tx-right wd-20p">Unit Price</th>
                <th class="tx-right wd-20p">Total Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach($invoice->products as $product)
              <tr>
                <td>{{ $product->product->name }}</td>
                <td class="tx-center">{{ $product->quantity . ' ' . $product->product->unit }}</td>
                <td class="tx-right">{{ $product->price . ' ' . settings()->currency }}</td>
                <td class="tx-right">{{ $invoice->total . ' ' . settings()->currency }}</td>
              </tr>
              @endforeach
              <tr>
                <td colspan="2" rowspan="4" class="valign-middle">
                @if(!empty($invoice->note))
                  <div class="mg-r-20">
                    <label class="tx-uppercase tx-13 tx-bold mg-b-10">Notes</label>
                    <p class="tx-13">{{ $invoice->note }} </p>
                  </div>
                @endif
                </td>
                <td class="tx-right">Discount</td>
                <td colspan="2" class="tx-right">{{ $invoice->discount . ' ' . settings()->currency }}</td>
              </tr>
              <tr>
                <td class="tx-right">Total Payable</td>
                <td colspan="2"  class="tx-right">{{ $invoice->total . ' ' . settings()->currency }}</td>
              </tr>
              <tr>
                <td class="tx-right">Total Paid</td>
                <td colspan="2" class="tx-right">{{ $invoice->paid . ' ' . settings()->currency }}</td>
              </tr>
              <tr>
                <td class="tx-right tx-uppercase tx-bold tx-inverse">Total Due</td>
                <td colspan="2" class="tx-right">
                  <h4 class="tx-primary tx-bold tx-lato">
                    {{ $invoice->due . ' ' . settings()->currency }}
                  </h4>
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- table-responsive -->

        <hr class="mg-b-60">

        <a href="{{ route('invoicedownload', $invoice->id) }}" class="btn btn-primary btn-block">Download Now</a>

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
<script src="{{ asset('public/lib/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('public/lib/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('public/js/shamcey.js') }}"></script>
<script>
  $(function() {
    'use strict';

    $('#datatable1').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      }
    });

    $('#datatable2').DataTable({
      bLengthChange: false,
      searching: false,
      responsive: true
    });

    // Select2
    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

  });
</script>
@endsection