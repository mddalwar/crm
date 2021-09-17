@extends('layouts.dashboard')

@section('title', 'Add Role')

@section('styles')
<!-- Vendor css -->
<link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
<link href="{{ asset('public/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="sh-breadcrumb">
	<nav class="breadcrumb">
		<a class="breadcrumb-item" href="{{ route('dashboard') }}">Dashboard</a>
    <a class="breadcrumb-item" href="{{ route('roles.index') }}">Roles</a>
		<span class="breadcrumb-item active">Add Role</span>
	</nav>
</div><!-- sh-breadcrumb -->

<div class="sh-pagebody">
  @if ($errors->any())      
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
  @endif

  @if (Session::has('role_empty'))      
    <div class="alert alert-danger">{{ Session::get('role_empty') }}</div>   
  @endif

  @if (Session::has('created'))      
    <div class="alert alert-success">{{ Session::get('created') }}</div>   
  @endif

  <div class="card bd-primary mg-t-20">
    <div class="card-header bg-primary tx-white">Add New Role</div>
    
    <form action="{{ route('roles.store') }}" method="POST">
      @csrf
      <div class="card-body pd-sm-30">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="rolename">Role Name <span class="text-danger">*</span></label>
              <input class="form-control" id="name" placeholder="Role Name" name="name" type="text" required="required" value="{{ old('name') }}">
            </div>         
          </div><!-- col -->
          <div class="col-lg-12 mb-3 mt-3">
            <h6 class="tx-inverse mg-b-0 text-center text-uppercase">Create Default Role Permissions</h6>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
                <label class="ckbox font-weight-bold tx-inverse mr-3">
                  <input type="checkbox" id="superadmin"><span>Super Admin</span>
                </label>
                <label class="ckbox font-weight-bold tx-inverse mr-3">
                  <input type="checkbox" id="admin"><span>Admin</span>
                </label>
                <label class="ckbox font-weight-bold tx-inverse mr-3">
                  <input type="checkbox" id="customer"><span>Customer</span>
                </label>
                <label class="ckbox font-weight-bold tx-inverse mr-3">
                  <input type="checkbox" id="Manager"><span>Manager</span>
                </label>
            </div>
          </div>
          <div class="col-lg-12 mb-3 mt-3">
            <h6 class="tx-inverse mg-b-0 text-center text-uppercase">Select Desire Permissions</h6>
          </div>
          <div class="col-lg-12">
            <div class="row mt-3">
              <div class="col-md-3 col-lg-3 users permissions">
                <h6 class="card-body-title">User</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="userview"><span>User View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="usercreate"><span>User Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="useredit"><span>User Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="userdelete"><span>User Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 col-lg-3 roles permissions">
                <h6 class="card-body-title">Role</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roleview"><span>Role View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="rolecreate"><span>Role Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roleedit"><span>Role Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roledelete"><span>Role Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 col-lg-3 customers permissions">
                <h6 class="card-body-title">Customer</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="customerview"><span>Customer View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="customercreate"><span>Customer Create</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="customeredit"><span>Customer Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="customerdelete"><span>Customer Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 col-lg-3 products permissions">
                <h6 class="card-body-title">Product</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="productview"><span>Product View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="productcreate"><span>Product Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="productedit"><span>Product Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="productdelete"><span>Product Delete</span>
                  </label>  
                </div>
              </div>
              <!-- Category -->
              <div class="col-md-3 col-lg-3 mt-3 categories permissions">
                <h6 class="card-body-title">Category</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categoryview"><span>Category View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categorycreate"><span>Category Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categoryedit"><span>Category Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categorydelete"><span>Category Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 col-lg-3 mt-3 stocks permissions">
                <h6 class="card-body-title">Stock</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="stockview"><span>Stock View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="stockadd"><span>Stock Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="stockedit"><span>Stock Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="stockdelete"><span>Stock Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 col-lg-3 mt-3 invoices permissions">
                <h6 class="card-body-title">Invoice</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="invoiceview"><span>Invoice View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="invoiceadd"><span>Invoice Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="invoiceedit"><span>Invoice Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="invoicedelete"><span>Invoice Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 col-lg-3 mt-3 collections permissions">
                <h6 class="card-body-title">Collection</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="collectionview"><span>Collection View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="collectionadd"><span>Collection Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="collectionedit"><span>Collection Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="collectiondelete"><span>Collection Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 col-lg-3 mt-3 expenses permissions">
                <h6 class="card-body-title">Expense</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="expensesview"><span>Expense View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="expensesadd"><span>Expense Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="expensesedit"><span>Expense Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="expensesdelete"><span>Expense Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 col-lg-3 mt-3 invests permissions">
                <h6 class="card-body-title">Invest</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="investview"><span>Invest View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="investadd"><span>Invest Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="investedit"><span>Invest Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="investdelete"><span>Invest Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 col-lg-3 mt-3 settings permissions">
                <h6 class="card-body-title">Setting Permission</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="settingsview"><span>Settings View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="settingsmanage"><span>Settings Manage</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="primaryapprover"><span>Primary Approver</span>
                  </label>
                </div>
              </div>
              <div class="col-md-3 col-lg-3 mt-3 access permissions">
                <h6 class="card-body-title">Access Permission</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="debit"><span>Debit</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="credit"><span>Credit</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="download"><span>Materials Download</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg mg-t-10 mg-lg-t-0 mt-3">
            <input type="submit" class="btn btn-primary" value="Add Role">
          </div><!-- col -->
        </div>
      </div><!-- card-body -->
    </form>
  </div>
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
<script>
    $(function() {
      'use strict';

      $(".user input[name='all']").click(function(){
        $('.user input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".role input[name='all']").click(function(){
        $('.role input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".customers input[name='all']").click(function(){
        $('.customers input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".products input[name='all']").click(function(){
        $('.products input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".stocks input[name='all']").click(function(){
        $('.stocks input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".invoices input[name='all']").click(function(){
        $('.invoices input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".collections input[name='all']").click(function(){
        $('.collections input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".category input[name='all']").click(function(){
        $('.category input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".expenses input[name='all']").click(function(){
        $('.expenses input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".invests input[name='all']").click(function(){
        $('.invests input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".settings input[name='all']").click(function(){
        $('.settings input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".access input[name='all']").click(function(){
        $('.access input:checkbox').not(this).prop('checked', this.checked);
      });

      $("#superadmin").click(function(){
        $(".customers input:checkbox").not(this).prop('checked', this.checked);
        $(".products input:checkbox").not(this).prop('checked', this.checked);
        $(".users input:checkbox").not(this).prop('checked', this.checked);
        $(".roles input:checkbox").not(this).prop('checked', this.checked);
        $(".stocks input:checkbox").not(this).prop('checked', this.checked);
        $(".collections input:checkbox").not(this).prop('checked', this.checked);
        $(".invests input:checkbox").not(this).prop('checked', this.checked);
        $(".expenses input:checkbox").not(this).prop('checked', this.checked);
        $(".categories input:checkbox").not(this).prop('checked', this.checked);
        $(".invoices input:checkbox").not(this).prop('checked', this.checked);
        $(".settings input:checkbox").not(this).prop('checked', this.checked);
      });

      $("#actingofficer, #workshopsuper, #headassistant, #registrar").click(function(){

        $("input[name='categoryview']").not(this).prop('checked', this.checked);

        $("input[name='materialview']").not(this).prop('checked', this.checked);
        $("input[name='materialapprove']").not(this).prop('checked', this.checked);

        $("input[name='locationview']").not(this).prop('checked', this.checked);        
        $("input[name='locationapprove']").not(this).prop('checked', this.checked);

        $("input[name='registerview']").not(this).prop('checked', this.checked);
        $("input[name='registerapprove']").not(this).prop('checked', this.checked);

        $("input[name='primaryapprover']").not(this).prop('checked', this.checked);
        $("input[name='download']").not(this).prop('checked', this.checked);
      });

      $("#hod").click(function(){
        $("input[name='categoryview']").not(this).prop('checked', this.checked);
        $("input[name='userview']").not(this).prop('checked', this.checked);
        $("input[name='sectionview']").not(this).prop('checked', this.checked);

        $("input[name='materialview']").not(this).prop('checked', this.checked);
        $("input[name='materialapprove']").not(this).prop('checked', this.checked);

        $("input[name='locationview']").not(this).prop('checked', this.checked);        
        $("input[name='locationapprove']").not(this).prop('checked', this.checked);

        $("input[name='registerview']").not(this).prop('checked', this.checked);
        $("input[name='registerapprove']").not(this).prop('checked', this.checked);

        $("input[name='download']").not(this).prop('checked', this.checked);
      });
  });
</script>
@endsection