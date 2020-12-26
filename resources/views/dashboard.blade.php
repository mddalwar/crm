@extends('layouts.layout')

@section('title', 'Dashboard')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="sh-pagebody">
  <div class="row row-sm">
    <div class="col-lg-8">     

      <div class="card bd-primary">
        <div class="card-header bg-primary tx-white">Current Month Summery</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_invest(date('m')) }}</span></h2>
                  <h5 class="tx-inverse ">Invest</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_sell(date('m')) }}</span></h2>
                  <h5 class="tx-inverse ">Sell</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_discount(date('m')) }}</span></h2>
                  <h5 class="tx-inverse ">Discount</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_due(date('m')) }}</span></h2>
                  <h5 class="tx-inverse ">Dues</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_expense(date('m')) }}</span></h2>
                  <h5 class="tx-inverse ">Expense</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ monthly_profit(date('m')) }}</span></h2>
                  <h5 class="tx-inverse">Profit</h5>
                </div>
              </div>
            </div>
            
          </div>
        </div><!-- card-body -->
      </div><!-- card -->
      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Overall Summery</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_invests() }}</span></h2>
                  <h5 class="tx-inverse ">Invest</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_sell() }}</span></h2>
                  <h5 class="tx-inverse ">Sell</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_dues() }}</span></h2>
                  <h5 class="tx-inverse ">Due</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_discount() }}</span></h2>
                  <h5 class="tx-inverse ">Discount</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_expense() }}</span></h2>
                  <h5 class="tx-inverse ">Expense</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ total_profit() }}</span></h2>
                  <h5 class="tx-inverse ">Profit</h5>
                </div>
              </div>
            </div>            
          </div>
        </div><!-- card-body -->
      </div><!-- card -->

    </div><!-- col-8 -->
    <div class="col-lg-4 mg-t-20 mg-lg-t-0">     

      <div class="card bd-primary card-calendar">
        <div class="card-header bg-primary tx-white">Calendar</div>
        <div class="datepicker"></div>
      </div><!-- card -->

      <div class="card bd-primary">
        <div class="card-header bg-primary tx-white">Current Balance</div>
        <div class="card-body">
          <div class="shortcut-icon mb-3">
            <div>
              <i class="icon ion-arrow-down-a"></i>
              <h2 class="tx-inverse">{{ current_balance() }}</h2>
              <h5 class="tx-inverse">Current Balance</h5>
            </div>
          </div> 
        </div><!-- card-body -->
      </div><!-- card --> 
    </div><!-- col-4 -->
  </div><!-- row -->
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
