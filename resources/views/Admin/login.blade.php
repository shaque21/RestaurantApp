<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login</title>

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/style.css" />
    <style>
        .form-control{
            width: 80%;
            border-radius: 20px;
            padding-left: 30px;
        }
        .form-control:focus{
            box-shadow: none;
        }
        body{
            background: linear-gradient(135deg, #130f40,#30336b);
        }
        .btn-dark{
            border-radius: 20px;
        }
        .login-form .card{
            max-width: 80%;
            margin-left: 10%;
        }
    </style>
  </head>
  <body>

    <div class="container vh-100 vw-100 d-flex justify-content-center align-items-center">
        <div class="login-form ">
                <div class="card">

                    <div class="card-body my-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 mt-3 d-flex justify-content-center align-items-center">
                                <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}" placeholder="name@example.com">
                            </div>
                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" placeholder="password">
                            </div>

                            <div class="form-group row my-2">
                                <div class="col-md-6 offset-md-3">
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            Forgot Your Password ?
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row my-3">
                                <div class="col-md-6 offset-md-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-dark ">
                                        <i class="bi bi-box-arrow-in-right"></i> &nbsp;
                                        {{ __('Sign In') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>


    <script src="{{ asset('components/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/jquery-3.5.1.js"></script>
    <script src="{{ asset('components/assets') }}/js/script.js"></script>
  </body>
</html>
