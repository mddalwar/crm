<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
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
            <h1 class="mg-b-0 tx-uppercase tx-gray-600 tx-mont text-right tx-bold">Invoice</h1>
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
              <h6 class="tx-inverse">{{ $invoice->customer->name }}</h6>
              <p class="m-0 tx-inverse">{{ $invoice->customer->address }}</p>
              @if(!empty($invoice->customer->email))
               <p class="m-0 tx-inverse"><strong>Email: </strong>{{ $invoice->customer->email }}</p>
              @endif
              @if(!empty($invoice->customer->phone)) 
               <p class="m-0 tx-inverse"><strong>Phone: </strong>{{ $invoice->customer->phone }}</p>
              @endif
            </div><!-- col --> 
            <div style="width: 49%; overflow: hidden;">
              <h5 class="tx-18-force tx-inverse tx-uppercase tx-bold mg-b-20">Invoice Information</h5>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Invoice No: </span>
                <span>INV-{{ $invoice->id }}</span>
              </p>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Customer Due: </span>
                <span>{{ $invoice->customer->due }}</span>
              </p>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
                <span>Create Date:</span>
                <span>{{ $invoice->created_at->format('F j, Y h:i:s A') }}</span>
              </p>
              <p class="d-flex tx-inverse justify-content-between mg-b-5">
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
                    <h4 class="tx-inverse tx-bold tx-lato">
                      {{ $invoice->due . ' ' . settings()->currency }}
                    </h4>
                  </td>
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