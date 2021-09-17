@extends('layouts.dashboard')

@section('title', 'Update Role')

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
		<span class="breadcrumb-item active">Update Role</span>
	</nav>
</div><!-- sh-breadcrumb -->
<div class="sh-pagetitle">
	<div class="sh-pagetitle-left">
		<div class="sh-pagetitle-icon"><i class="icon ion-edit"></i></div>
		<div class="sh-pagetitle-title">
			<h2>Update Role</h2>
		</div><!-- sh-pagetitle-left-title -->
	</div><!-- sh-pagetitle-left -->
</div><!-- sh-pagetitle -->

<div class="sh-pagebody">
  @if ($errors->any())      
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
  @endif

  @if (Session::has('role_empty'))      
    <div class="alert alert-danger">{{ Session::get('role_empty') }}</div>   
  @endif

  @if (Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>   
  @endif

  <div class="card bd-primary mg-t-20">
    <div class="card-header bg-primary tx-white">Update Role</div>
    
    <form action="{{ route('roles.update', $role->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="card-body pd-sm-30">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="name">Role Name <span class="text-danger">*</span></label>
              <input class="form-control" id="name" placeholder="Role Name" name="name" type="text" required="required" value="{{ $role->name }}">
            </div>         
          </div><!-- col -->
          <div class="col-lg-12 mb-3 mt-3">
            <h6 class="tx-inverse mg-b-0 text-center text-uppercase">Select Desire Permissions</h6>
          </div>
          <div class="col-lg-12">
            <div class="row mt-3">
              <div class="col-md-3 user permissions">
                <h6 class="card-body-title">User</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="userview" @if(array_key_exists('userview', $permissions)) {{'checked'}} @endif>
                    <span>User View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="usercreate" @if(array_key_exists('usercreate', $permissions)) {{'checked'}} @endif>
                    <span>User Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="useredit" @if(array_key_exists('useredit', $permissions)) {{'checked'}} @endif>
                    <span>User Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="userdelete" @if(array_key_exists('userdelete', $permissions)) {{'checked'}} @endif>
                    <span>User Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 role permissions">
                <h6 class="card-body-title">Role</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roleview" @if(array_key_exists('roleview', $permissions)) {{'checked'}} @endif>
                    <span>Role View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="rolecreate" @if(array_key_exists('rolecreate', $permissions)) {{'checked'}} @endif>
                    <span>Role Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roleedit" @if(array_key_exists('roleedit', $permissions)) {{'checked'}} @endif>
                    <span>Role Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="roledelete" @if(array_key_exists('roledelete', $permissions)) {{'checked'}} @endif>
                    <span>Role Delete</span>
                  </label>  
                </div>
              </div>
              <div class="col-md-3 department permissions">
                <h6 class="card-body-title">Department</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="deptview" @if(array_key_exists('deptview', $permissions)) {{'checked'}} @endif>
                    <span>Depertment View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="deptcreate" @if(array_key_exists('deptcreate', $permissions)) {{'checked'}} @endif>
                    <span>Depertment Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="deptedit" @if(array_key_exists('deptedit', $permissions)) {{'checked'}} @endif>
                    <span>Depertment Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="deptdelete" @if(array_key_exists('deptdelete', $permissions)) {{'checked'}} @endif>
                    <span>Depertment Delete</span>
                  </label>
                </div>
              </div>
              <div class="col-md-3 section permissions">
                <h6 class="card-body-title">Store</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="storeview" @if(array_key_exists('storeview', $permissions)) {{'checked'}} @endif>
                    <span>Store View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="storecreate" @if(array_key_exists('storecreate', $permissions)) {{'checked'}} @endif>
                    <span>Store Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="storeedit" @if(array_key_exists('storeedit', $permissions)) {{'checked'}} @endif>
                    <span>Store Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="storedelete" @if(array_key_exists('storedelete', $permissions)) {{'checked'}} @endif>
                    <span>Store Delete</span>
                  </label>  
                </div>
              </div>

              <!-- Category -->
              <div class="col-md-3 col-lg-3 mt-3 category permissions">
                <h6 class="card-body-title">Category</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categoryview" @if(array_key_exists('categoryview', $permissions)) {{'checked'}} @endif><span>Category View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categorycreate" @if(array_key_exists('categorycreate', $permissions)) {{'checked'}} @endif><span>Category Create</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categoryedit" @if(array_key_exists('categoryedit', $permissions)) {{'checked'}} @endif><span>Category Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="categorydelete" @if(array_key_exists('categorydelete', $permissions)) {{'checked'}} @endif><span>Category Delete</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 mt-3 material permissions">
                <h6 class="card-body-title">Material</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="materialview" @if(array_key_exists('materialview', $permissions)) {{'checked'}} @endif>
                    <span>Material View</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="materialadd" @if(array_key_exists('materialadd', $permissions)) {{'checked'}} @endif>
                    <span>Material Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="materialedit" @if(array_key_exists('materialedit', $permissions)) {{'checked'}} @endif>
                    <span>Material Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="materialdelete" @if(array_key_exists('materialdelete', $permissions)) {{'checked'}} @endif>
                    <span>Material Delete</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="materialapprove" @if(array_key_exists('materialapprove', $permissions)) {{'checked'}} @endif>
                    <span>Material Approve</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 mt-3 location permissions">
                <h6 class="card-body-title">Location</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="locationview" @if(array_key_exists('locationview', $permissions)) {{'checked'}} @endif>
                    <span>Location View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="locationadd" @if(array_key_exists('locationadd', $permissions)) {{'checked'}} @endif>
                    <span>Location Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="locationedit" @if(array_key_exists('locationedit', $permissions)) {{'checked'}} @endif>
                    <span>Location Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="locationdelete" @if(array_key_exists('locationdelete', $permissions)) {{'checked'}} @endif>
                    <span>Location Delete</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="locationapprove" @if(array_key_exists('locationapprove', $permissions)) {{'checked'}} @endif>
                    <span>Location Approve</span>
                  </label>  
                </div>
              </div>


              <div class="col-md-3 mt-3 register permissions">
                <h6 class="card-body-title">Register</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="registerview" @if(array_key_exists('registerview', $permissions)) {{'checked'}} @endif><span>Register View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="registeradd" @if(array_key_exists('registeradd', $permissions)) {{'checked'}} @endif><span>Register Add</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="registeredit" @if(array_key_exists('registeredit', $permissions)) {{'checked'}} @endif><span>Register Edit</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="registerdelete" @if(array_key_exists('registerdelete', $permissions)) {{'checked'}} @endif><span>Register Delete</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="registerapprove" @if(array_key_exists('registerapprove', $permissions)) {{'checked'}} @endif><span>Register Approve</span>
                  </label>  
                </div>
              </div>

              <div class="col-md-3 mt-3 others permissions">
                <h6 class="card-body-title">Others Permission</h6>
                <div class="form-group">
                  <label class="ckbox font-weight-bold tx-inverse">
                    <input type="checkbox" name="all"><span>All</span>
                  </label>  
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="settingsview" @if(array_key_exists('settingsview', $permissions)) {{'checked'}} @endif>
                    <span>Settings View</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="settingsmanage" @if(array_key_exists('settingsmanage', $permissions)) {{'checked'}} @endif>
                    <span>Settings Manage</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="primaryapprover" @if(array_key_exists('primaryapprover', $permissions)) {{'checked'}} @endif>
                    <span>Primary Approver</span>
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
                    <input type="checkbox" name="debit" @if(array_key_exists('debit', $permissions)) {{'checked'}} @endif><span>Debit</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="credit" @if(array_key_exists('credit', $permissions)) {{'checked'}} @endif><span>Credit</span>
                  </label>
                </div>
                <div class="form-group">
                  <label class="ckbox">
                    <input type="checkbox" name="download" @if(array_key_exists('download', $permissions)) {{'checked'}} @endif><span>Materials Download</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg mg-t-10 mg-lg-t-0 mt-3">
            <input type="submit" class="btn btn-primary" value="Update Role">
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

      $(".department input[name='all']").click(function(){
        $('.department input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".section input[name='all']").click(function(){
        $('.section input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".material input[name='all']").click(function(){
        $('.material input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".location input[name='all']").click(function(){
        $('.location input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".category input[name='all']").click(function(){
        $('.category input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".register input[name='all']").click(function(){
        $('.register input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".others input[name='all']").click(function(){
        $('.others input:checkbox').not(this).prop('checked', this.checked);
      });

      $(".access input[name='all']").click(function(){
        $('.access input:checkbox').not(this).prop('checked', this.checked);
      });
  });
</script>
@endsection