@extends('layouts.app',['title'=>'login Page'])

@section('content')
<div class="container">

    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body login-card">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Sign In</h2>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row my-2">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-8 offset-sm-2">
                                <input id="email" type="email" class="form-control-lg @error('email') is-invalid @enderror" placeholder="Enter Your Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-8 offset-sm-2">
                                <input id="password" type="password" class="form-control-lg @error('password') is-invalid @enderror" placeholder="Enter Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <div class="col-md-6 offset-md-4">
                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        Forgot Your Password ?
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3 d-grid gap-2">
                                <button type="submit" class="btn btn-dark btn-lg">
                                    <i class="bi bi-box-arrow-in-right mr-2"></i>
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group row mb-0 my-2">
                            <div class="col-md-6 offset-md-3 text-center">
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    {{ __('Don\'t Have An Account? Sign Up') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
