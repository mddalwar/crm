<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login | Customer Relation Managment by Md Dalwar</title>

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
            <h2>
                @if(!is_null(settings()->logotext))
                    {{ settings()->logotext }}
                @endif
            </h2>

            
            <p class="mg-b-0">
                @if(!is_null(settings()->logotext))
                    {{ settings()->address }}
                @endif
            </p>
          
        </div><!-- signbox-header -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="signbox-body">
                <div class="form-group">
                    <label for="email" class="form-control-label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="form-control-label">{{ __('Password') }}</label>
                    <input id="password" type="password" placeholder="Your Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="form-group">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
              </div><!-- form-group -->
              <button class="btn btn-primary btn-block">Login</button>
            </div><!-- signbox-body -->
        </form>
      </div><!-- signbox -->
    </div><!-- signpanel-wrapper -->

    <script src="{{ asset('public/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('public/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('public/lib/bootstrap/bootstrap.js') }}"></script>

    <script src="{{ asset('public/js/shamcey.js') }}"></script>
  </body>
</html>

