@extends('layouts.app',['title'=>'Password Reset'])

@section('content')
<div class="container">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body login-card">
                    <div class="row my-3">
                        <div class="col-12 text-center">
                            <h2>Reset Password</h2>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="mb-3 d-flex justify-content-center align-items-center">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email-Address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 ">
                            <div class="col-md-8 offset-3">
                                <button type="submit" class="btn btn-dark ">
                                    <i class="bi bi-folder-symlink"></i>&nbsp;
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection