@extends('layouts.dashboard')

@section('title', 'Single Collection')

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
      <a class="breadcrumb-item" href="{{ route('collections.index') }}">Collections</a>
      <span class="breadcrumb-item active">Collection</span>
    </nav>
</div><!-- sh-breadcrumb -->

<div class="sh-pagebody">

    <div class="card bd-primary">
      <div class="card-body pd-30 pd-md-60">
        <div class="d-md-flex justify-content-between flex-row-reverse">
          <h1 class="mg-b-0 tx-uppercase tx-gray-400 tx-mont tx-bold">Collection</h1>
          <div class="mg-t-25 mg-md-t-0">

            <h6 class="tx-primary">{{ settings()->shopname }}</h6>
            <p class="lh-7">{{ settings()->address }}<br>
            Mobile: 0{{ settings()->phone }}<br>
            @if( !empty(settings()->email) )
            Email: {{ settings()->email }}</p>
            @endif
          </div>
        </div><!-- d-flex -->

        <div class="row mg-t-20">
          <div class="col-md">
            <label class="tx-uppercase tx-13 tx-bold mg-b-20">Customer Info:</label>
            <h6 class="tx-inverse">{{ $collection->customer->name }}</h6>
            <p class="m-0">{{ $collection->customer->address }}</p>
            @if(!empty($collection->customer->email))
          	 <p class="m-0"><strong>Email: </strong>{{ $collection->customer->email }}</p>
            @endif
            @if(!empty($collection->customer->phone))
          	 <p class="m-0"><strong>Phone: </strong>{{ $collection->customer->phone }}</p>
            @endif
          </div><!-- col -->
          <div class="col-md">
            <label class="tx-uppercase tx-13 tx-bold mg-b-20">Collection Information:</label>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Collection No:</span>
              <span>COL-{{ $collection->id }}</span>
            </p>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Collect Date:</span>
              <span>{{ $collection->created_at->format('F j, Y h:i:s A') }}</span>
            </p>
            <p class="d-flex justify-content-between mg-b-5">
              <span>Collected By:</span>
              <span>{{ $collection->created_by->firstname . ' ' . $collection->created_by->lastname }}</span>
            </p>
          </div><!-- col -->
        </div><!-- row -->

        <div class="table-responsive mg-t-40">
          <table class="table">
            <thead>
              <tr>
                <th class="wd-40p">Title</th>
                <th class="tx-center wd-20p">Collect Amount</th>
                <th class="tx-center wd-20p">Present Due</th>
                <th class="tx-center wd-20p">Collect By</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  @if(!empty($collection->note))
                    {{ $collection->note }}
                  @else
                    {{ 'Due Amount Collection' }}
                  @endif
                </td>
                <td class="tx-center">{{ $collection->amount . ' ' . settings()->currency }}</td>
                <td class="tx-center">{{ $collection->customer->due . ' ' . settings()->currency }}</td>
                <td class="tx-center">{{ $collection->created_by->firstname . ' ' . $collection->created_by->lastname }}</td>                
              </tr>
              
            </tbody>
          </table>
        </div><!-- table-responsive -->

        <hr class="mg-b-60">

        <a href="{{ route('collectiondownload', $collection->id) }}" class="btn btn-primary btn-block">Download</a>

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