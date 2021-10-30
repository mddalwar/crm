<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collection</title>
  <!-- Vendor css -->
  <link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
  <link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
  <link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
  <link href="{{ asset('public/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
  <link href="{{ asset('public/lib/select2/css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/shamcey.css') }}" rel="stylesheet">
</head>
<body style="background-color: #ffffff;">
    <div class="page-wrapper">
      <div class="card-body">
        <div class="pd-30 pd-md-60">
          <div class="d-md-flex justify-content-between flex-row-reverse">
            <h1 class="mg-b-0 tx-uppercase tx-gray-600 tx-mont text-right tx-bold">Collection</h1>
            <div class="mg-t-25 mg-md-t-0">

              <h3 class="tx-primary">{{ settings()->shopname }}</h3>
              <p class="lh-7 tx-inverse">{{ settings()->address }}<br>
              Mobile: 0{{ settings()->phone }}<br>
              @if(!empty(settings()->email))
              Email: {{ settings()->email }}</p>
              @endif
            </div>
          </div><!-- d-flex -->

          <div class="mg-t-20">
            <div class="float-left" style="width: 49%; margin-right: 2%;">
              <h5 class="tx-uppercase tx-inverse tx-18-force tx-bold tx-secondary mg-b-20">Billed To</h5>
              <h6 class="tx-inverse">{{ $collection->customer->name }}</h6>
              <p class="m-0 tx-inverse">{{ $collection->customer->address }}</p>
              @if(!empty($collection->customer->email))
               <p class="m-0 tx-inverse"><strong>Email: </strong>{{ $collection->customer->email }}</p>
              @endif
              @if(!empty($collection->customer->phone)) 
               <p class="m-0 tx-inverse"><strong>Phone: </strong>{{ $collection->customer->phone }}</p>
              @endif
            </div><!-- col --> 
            <div style="width: 49%; overflow: hidden;">
              <h5 class="tx-18-force tx-inverse tx-uppercase tx-bold mg-b-20">Collection Information</h5>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Collection No: </span>
                <span>COL-{{ $collection->id }}</span>
              </p>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Create Date:</span>
                <span>{{ $collection->created_at->format('F j, Y h:i:s A') }}</span>
              </p>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Created By:</span>
                <span>{{ $collection->created_by->firstname . ' ' . $collection->created_by->lastname }}</span>
              </p>
            </div><!-- col -->
          </div>

          <div class="table-responsive mg-t-40">
            <table class="table">
              	<thead>
	            	<tr>
		                <th class="wd-30p">Title</th>
		                <th class="tx-center wd-25p">Collect Amount</th>
		                <th class="tx-center wd-20p">Present Due</th>
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
	            	</tr>
            	</tbody>
            </table>
          </div><!-- table-responsive -->

          <table style="width: 100%; margin-top: 50px;">
          	<tr>
          		<td class="tx-inverse" style="width: 50%;">Customer Signature</td>
          		<td class="tx-inverse" style="width: 50%; text-align: right;">Manager</td>
          	</tr>
          </table>

        </div><!-- card-body -->
      </div><!-- card -->

  </div><!-- sh-pagebody -->
</body>
</html>