<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('title')    

    @yield('styles')

    <!-- Shamcey CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/shamcey.css') }}">
  </head>

  <body>

    <div class="sh-logopanel">
      <a href="{{ route('dashboard') }}" class="sh-logo-text">
      @php
        $logotext_query = DB::table('settings')->where('setting_key', 'logotext')->get();
        $logotext = $logotext_query[0]->setting_value;

        $user = auth()->user();
      @endphp
      
      @if(!empty( $logotext ))
      <h2>{{ $logotext }}</h2>
      @else
          <h2>Logo</h2>
      @endif
      </a>
      <a id="navicon" href="" class="sh-navicon d-none d-xl-block"><i class="icon ion-navicon"></i></a>
      <a id="naviconMobile" href="" class="sh-navicon d-xl-none"><i class="icon ion-navicon"></i></a>
    </div><!-- sh-logopanel -->

    <div class="sh-sideleft-menu">
      <label class="sh-sidebar-label">Navigation</label>
      <ul class="nav">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="icon ion-ios-home-outline"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- nav-item -->
        
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-ios-list-outline"></i>
            <span>Products</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link">Products</a></li>
            @if($user->designation == 'Super Admin' || $user->designation == 'Admin')
            <li class="nav-item"><a href="{{ route('products.create') }}" class="nav-link">Add Product</a></li>
            @endif
          </ul>
        </li><!-- nav-item -->
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-document-text"></i>
            <span>Invoices</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('invoices.index') }}" class="nav-link">Invoices</a></li>
            <li class="nav-item"><a href="{{ route('invoices.create') }}" class="nav-link">Create Invoice</a></li>
          </ul>
        </li><!-- nav-item -->
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-document-text"></i>
            <span>Expenses</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('expenses.index') }}" class="nav-link">Expenses</a></li>
            <li class="nav-item"><a href="{{ route('expenses.create') }}" class="nav-link">Create Expense</a></li>
          </ul>
        </li><!-- nav-item -->
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person-stalker"></i>
            <span>Customers</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="{{ route('customers.create') }}" class="nav-link">Add Customer</a></li>
          </ul>
        </li><!-- nav-item -->
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person-stalker"></i>
            <span>Investments</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('invests.index') }}" class="nav-link">Investments</a></li>
            <li class="nav-item"><a href="{{ route('invests.create') }}" class="nav-link">New Invest</a></li>
          </ul>
        </li><!-- nav-item -->
        @if($user->designation == 'Super Admin' || $user->designation == 'Admin' || $user->designation == 'Manager')
        <li class="nav-item">
          <a href="" class="nav-link with-sub">
            <i class="icon ion-person"></i>
            <span>Users</span>
          </a>
          <ul class="nav-sub">
            <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Users</a></li>
            @if($user->designation == 'Super Admin')
            <li class="nav-item"><a href="{{ route('users.create') }}" class="nav-link">Add User</a></li>
            @endif
          </ul>
        </li><!-- nav-item -->
        @endif
        @if($user->designation == 'Super Admin')
        <li class="nav-item">
          <a href="{{ route('settings') }}" class="nav-link">
            <i class="icon ion-gear-b"></i>
            <span>Settings</span>
          </a>
        </li><!-- nav-item -->
        @endif
      </ul>
    </div><!-- sh-sideleft-menu -->

    <div class="sh-headpanel">
      <div class="sh-headpanel-left">

        <!-- START: HIDDEN IN MOBILE -->
        <a href="{{ route('addstock') }}" class="sh-icon-link">
          <div>
            <i class="icon ion-ios-folder-outline"></i>
            <span>Add Stock</span>
          </div>
        </a>
        <a href="{{ route('products.create') }}" class="sh-icon-link">
          <div>
            <i class="icon ion-ios-calendar-outline"></i>
            <span>Add Product</span>
          </div>
        </a>
        <a href="{{ route('invoices.create') }}" class="sh-icon-link">
          <div>
            <i class="icon ion-document-text"></i>
            <span>Create Invoice</span>
          </div>
        </a>
        <!-- END: HIDDEN IN MOBILE -->

        <!-- START: DISPLAYED IN MOBILE ONLY -->
        <div class="dropdown dropdown-app-list">
          <a href="" data-toggle="dropdown" class="dropdown-link">
            <i class="icon ion-ios-keypad tx-18"></i>
          </a>
          <div class="dropdown-menu">
            <div class="row no-gutters">
              <div class="col-4">
                <a href="" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-folder-outline"></i>
                    <span>Directory</span>
                  </div>
                </a>
              </div><!-- col-4 -->
              <div class="col-4">
                <a href="" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-calendar-outline"></i>
                    <span>Events</span>
                  </div>
                </a>
              </div><!-- col-4 -->
              <div class="col-4">
                <a href="" class="dropdown-menu-link">
                  <div>
                    <i class="icon ion-ios-gear-outline"></i>
                    <span>Settings</span>
                  </div>
                </a>
              </div><!-- col-4 -->
            </div><!-- row -->
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <!-- END: DISPLAYED IN MOBILE ONLY -->

      </div><!-- sh-headpanel-left -->

      <div class="sh-headpanel-right">
        <div class="dropdown dropdown-profile">
          <a href="" data-toggle="dropdown" class="dropdown-link">
            <img src="{{ asset('public/img/img1.jpg') }}" class="wd-60 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="media align-items-center">
              <img src="{{ asset('public/img/img1.jpg') }}" class="wd-60 ht-60 rounded-circle bd pd-5" alt="">
              <div class="media-body">
                <h6 class="tx-inverse tx-15 mg-b-5">{{ $user->firstname }}</h6>
                <p class="mg-b-0 tx-12">{{ $user->email }}</p>
              </div><!-- media-body -->
            </div><!-- media -->
            <hr>
            <ul class="dropdown-profile-nav">
              <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
              <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
              <li><a href=""><i class="icon ion-ios-download"></i> Downloads</a></li>
              <li><a href=""><i class="icon ion-ios-star"></i> Favorites</a></li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn-link" type="submit"><i class="icon ion-power"></i> Sign Out</button>
                </form>
              </li>
            </ul>
          </div><!-- dropdown-menu -->
        </div>
      </div><!-- sh-headpanel-right -->
    </div><!-- sh-headpanel -->
    <div class="sh-mainpanel">
        @yield('content')
        <div class="sh-footer">
          @php
            $copyright_query = DB::table('settings')->where('setting_key', 'copyright')->get();
            $copyright = $copyright_query[0]->setting_value;
          @endphp
          
          @if(!empty($copyright))
            <div>{{ $copyright }}</div>
          @else
            <div>Copyright © 2020. All Rights Reserved.</div>
          @endif
            
          <div class="mg-t-10 mg-md-t-0">Developed by: <a href="http://wpcoderpro.com">Md Dalwar</a></div>
        </div><!-- sh-footer -->
    </div>
    


    @yield('scripts')

  </body>
</html>
