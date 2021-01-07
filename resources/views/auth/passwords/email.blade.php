<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Password Reset Request | Customer Relation Managment by Md Dalwar</title>

    <!-- Vendor css -->
    <link href="{{ asset('public/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">

    <!-- Shamcey CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/shamcey.css') }}">
  </head>

  <body class="bg-gray-900">

    <div class="signpanel-wrapper">
      <div class="signbox">
        <div class="signbox-header">
            <h2>{{ logotext() }}</h2>

            @if(address())
                <p class="mg-b-0">{{ address() }}</p>
            @else
                <p class="mg-b-0">Customer Relation Software</p>
            @endif
        </div><!-- signbox-header -->

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="signbox-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">{{ __('Account Email') }}</label>                
                    <input id="email" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Reset Link') }}
                    </button>
                </div>
            </div>
        </form>
    </div><!-- signbox -->
    </div><!-- signpanel-wrapper -->

    <script src="{{ asset('public/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('public/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('public/lib/bootstrap/bootstrap.js') }}"></script>

    <script src="{{ asset('public/js/shamcey.js') }}"></script>
  </body>
</html>