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
      <div class="row row-xs">
        <div class="col-6 col-sm-4 col-md">
          <a href="{{ route('invoices.create') }}" class="shortcut-icon">
            <div>
              <i class="icon ion-ios-albums-outline"></i>
              <span>Create Invoice</span>
            </div>
          </a>
        </div><!-- col -->
        <div class="col-6 col-sm-4 col-md">
          <a href="{{ route('products.create') }}" class="shortcut-icon">
            <div>
              <i class="icon ion-ios-analytics-outline"></i>
              <span>Add Product</span>
            </div>
          </a>
        </div><!-- col -->
        <div class="col-6 col-sm-4 col-md mg-t-10 mg-sm-t-0">
          <a href="{{ route('expenses.create') }}" class="shortcut-icon">
            <div>
              <i class="icon ion-ios-bookmarks-outline"></i>
              <span>Add Expense</span>
            </div>
          </a>
        </div><!-- col -->
        <div class="col-6 col-sm-4 col-md mg-t-10 mg-md-t-0">
          <a href="{{ route('invests.create') }}" class="shortcut-icon">
            <div>
              <i class="icon ion-ios-chatboxes-outline"></i>
              <span>Add Invest</span>
            </div>
          </a>
        </div><!-- col -->
        <div class="col-6 col-sm-4 col-md mg-t-10 mg-md-t-0">
          <a href="{{ route('products.index') }}" class="shortcut-icon">
            <div>
              <i class="icon ion-ios-download-outline"></i>
              <span>All Products</span>
            </div>
          </a>
        </div><!-- col -->
      </div><!-- row -->
      @php

        $currentMonth = date('m');

        $current_month_sell = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('invoices.totalamount');

        $current_month_discount = DB::table("invoices")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('invoices.discount');

        $current_month_invest = DB::table("invests")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('invests.amount');

        $current_month_expense = DB::table("expenses")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('expenses.amount');

        $current_month_dues = DB::table("customers")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('customers.due');

        $total_dues = DB::table("customers")
            ->sum('customers.due');

        $total_invest = DB::table("invests")
            ->sum('invests.amount');
      @endphp

      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Monthly Summery</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $current_month_invest }}</span></h2>
                  <h5 class="tx-inverse ">Monthly Invest</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $current_month_sell - $current_month_discount }}</span></h2>
                  <h5 class="tx-inverse ">Monthly Sell</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $current_month_expense }}</span></h2>
                  <h5 class="tx-inverse ">Monthly Expense</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $current_month_sell - $current_month_discount - $current_month_expense}}</span></h2>
                  <h5 class="tx-inverse ">Monthly Profit</h5>
                </div>
              </div>
            </div>
            
          </div>
        </div><!-- card-body -->
      </div><!-- card -->

      @php

        $total_sell = DB::table("invoices")
            ->sum('invoices.totalamount');

        $total_discount = DB::table("invoices")
            ->sum('invoices.discount');

        $total_expense = DB::table("expenses")
            ->sum('expenses.amount');

        $total_dues = DB::table("customers")
            ->sum('customers.due');

        $total_invest = DB::table("invests")
            ->sum('invests.amount');
      @endphp

      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Overall Summery</div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $total_invest }}</span></h2>
                  <h5 class="tx-inverse ">Total Invest</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $total_sell - $total_discount }}</span></h2>
                  <h5 class="tx-inverse ">Total Sell</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $total_expense }}</span></h2>
                  <h5 class="tx-inverse ">Total Expense</h5>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="shortcut-icon mb-3">
                <div>
                  <i class="icon ion-arrow-down-a"></i>
                  <h2 class="tx-inverse"><span>{{ $total_sell - $total_discount - $total_expense}}</span></h2>
                  <h5 class="tx-inverse ">Total Profit</h5>
                </div>
              </div>
            </div>
            
          </div>
        </div><!-- card-body -->
      </div><!-- card -->

    </div><!-- col-8 -->
    <div class="col-lg-4 mg-t-20 mg-lg-t-0">

      <div class="card bd-primary">
        <div class="card-header bg-primary tx-white">Overall Balance</div>
        <div class="card-body">
          <div class="shortcut-icon mb-3">
            <div>
              @php
                $total_profit = $total_sell - $total_discount - $total_expense;
                $overall_sell = $total_sell - $total_discount;
                $present_balance = $total_invest + $total_profit - $total_dues;
              @endphp
              <i class="icon ion-arrow-down-a"></i>
              <h2 class="tx-inverse">{{ $present_balance }}</h2>
              <h5 class="tx-inverse">Current Balance</h5>
            </div>
          </div> 
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="card bd-primary card-calendar mg-t-20">
        <div class="card-header bg-primary tx-white">Calendar</div>
        <div class="datepicker"></div>
      </div><!-- card -->

      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">This Month Dues</div>
        <div class="card-body">
          <div class="shortcut-icon mb-3">
            <div>
              <i class="icon ion-arrow-down-a"></i>
              <h2 class="tx-inverse">{{ $current_month_dues }}</h2>
              <h5 class="tx-inverse ">Monthly Dues</h5>
            </div>
          </div> 
        </div><!-- card-body -->
      </div><!-- card -->
      
      <div class="card bd-primary mg-t-20">
        <div class="card-header bg-primary tx-white">Overall Dues</div>
        <div class="card-body">
          <div class="shortcut-icon mb-3">
            <div>
              <i class="icon ion-arrow-down-a"></i>
              <h2 class="tx-inverse">{{ $total_dues }}</h2>
              <h5 class="tx-inverse ">Total Dues</h5>
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
