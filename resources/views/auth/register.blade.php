@extends('layouts.app',['title'=>'Registration Page'])

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container mt-sm-5 form-section">
    <div class="row">
        <div class="col-sm-8 offset-2 main-form bg-white">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Restaurant App</h2>
                </div>
            </div>
            <div class="row mt-sm-5 switch-btn">
                <div id="customer_reg" class="col-sm-6 text-center  ">Customer Registration</div>
                <div id="restaurent_reg" class="col-sm-6 text-center">Restaurant Registration</div>
            </div>
            <div class="row my-sm-4 customer-form">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-8 offset-sm-2 d-flex justify-content-center align-items-center">
                            <a class="social-icon me-5" href=""><i class="bi bi-facebook"></i></a>
                            <a class="social-icon me-5" href=""><i class="bi bi-google"></i></a>
                            <a class="social-icon" href=""><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                    <div class="row my-sm-4">
                        <form method="POST" action="{{ route('register') }}"> @csrf
                            <div class="col-sm-8 offset-sm-2 ">
                                <div class="mb-3">
                                    <input type="text" class="form-control-lg @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="New Password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control-lg" id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                                <div class="d-grid gap-2 mt-sm-4">
                                    <button type="submit" class="btn btn-dark btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i>
                                        Register Here
                                    </button>
                                </div>
                                <div class="my-sm-4">
                                    <a href="{{ route('login') }}">Already Have An Account ? </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row my-sm-5 restaurent-form"  >
                <form method="POST" action="{{ url('/add-restaurent-owner') }}">@csrf
                    <div class="col-sm-8 offset-sm-2 ">
                        <div class="mb-3">
                            <input required type="text" class="form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                            {{-- <input type="text" class="form-control-lg" id="name" name="name" placeholder="Enter Your Name"> --}}
                        </div>
                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input required type="email" class="form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Your Email">

                            {{-- <input type="email" class="form-control-lg" id="email" name="email" placeholder="Enter Your Email"> --}}
                        </div>
                        @error('email')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input required type="text" class="form-control-lg" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter Your Phone Number">

                            {{-- <input type="text" class="form-control-lg" id="phone" name="phone" placeholder="Enter Your Phone Number"> --}}
                        </div>
                        @error('phone')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input required type="text" class="form-control-lg" id="rst_name" name="rst_name" value="{{ old('rst_name') }}" placeholder="Enter Your Restaurant Name">

                            {{-- <input type="text" class="form-control-lg" id="restaurent_name" name="restaurent_name" placeholder="Enter Your Restaurant Name"> --}}
                        </div>

                        @error('rst_name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-floating mb-3">
                            <textarea required class="form-control-lg" placeholder="Restaurant Address" name="rst_address" id="rst_address" value="{{ old('rst_address') }}" rows="2"></textarea>

                            {{-- <textarea class="form-control-lg" placeholder="Restaurant Address"  name="restaurent_address"></textarea> --}}
                            <!-- <label for="floatingTextarea">Comments</label> -->
                        </div>
                        @error('rst_address')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input required type="password" class="form-control-lg" id="password" name="password"  placeholder="New Password">

                            {{-- <input type="password" class="form-control-lg" id="password" name="password" placeholder="New Password"> --}}

                        </div>
                        @error('password')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            <input required type="password" class="form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">

                            {{-- <input type="password" class="form-control-lg" id="confirm_password" name="confirm_password" placeholder="Confirm Password"> --}}
                        </div>
                        @error('password_confirmation')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        <div class="mb-3">
                            {{-- <label for="exampleFormControlInput1" class="form-label">Email address</label> --}}
                            <input type="hidden" class="form-control-lg" id="role_id" name="role_id" value="2">
                        </div>
                        <div class="d-grid gap-2 mt-sm-4">
                            <button type="submit" class="btn btn-dark btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Register Here
                            </button>
                        </div>
                        <div class="my-sm-4">
                            <a href="{{ route('login') }}">Already Have An Account ? </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script>

    $(document).ready(function(){
        $(".restaurent-form").hide();
        $("#customer_reg").addClass('reg_active');

        $("#customer_reg").on("click",function(){
            $(".customer-form").slideDown(200);
            $(".restaurent-form").slideUp(200);
            $(this).addClass('reg_active');
            $("#restaurent_reg").removeClass('reg_active');

        });
        $("#restaurent_reg").on("click",function(){
            $(".restaurent-form").slideDown(200);
            $(".customer-form").slideUp(200);
            $(this).addClass('reg_active');
            $("#customer_reg").removeClass('reg_active');
        });

    });


    </script>
@endsection
