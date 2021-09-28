<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restaurent Owner Registraion</title>

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/style.css" />

  </head>
  <body>

    <div class="container">

        <div class="form my-5 d-flex justify-content-center align-items-center">
            <form method="POST" action="{{ url('/add-restaurent-owner') }}">
                @csrf
                <div class="card">

                    <div class="card-header">
                        <div class="title">
                            <h4>Restaurent Owner Registration</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control form-control-sm" id="name" name="name" value="{{ old('name') }}" placeholder="enter your name">
                        </div>

                        @error('name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror


                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input required type="email" class="form-control form-control-sm" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                        </div>

                        @error('email')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone No.</label>
                            <input required type="text" class="form-control form-control-sm" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+880 1627 301020">
                        </div>

                        @error('phone')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="rst_name" class="form-label">Restaurent Name</label>
                            <input required type="text" class="form-control form-control-sm" id="rst_name" name="rst_name" value="{{ old('rst_name') }}" placeholder="enter restaurent name">
                        </div>

                        @error('rst_name')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="rst_address" class="form-label">Restaurent Address</label>
                            <textarea required class="form-control form-control-sm" name="rst_address" id="rst_address" value="{{ old('rst_address') }}" rows="2"></textarea>
                        </div>

                        @error('rst_address')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input required type="password" class="form-control form-control-sm" id="password" name="password"  placeholder="password">
                        </div>

                        @error('password')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input required type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                        </div>

                        @error('password_confirmation')
                            <span class="alert alert-danger">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            {{-- <label for="exampleFormControlInput1" class="form-label">Email address</label> --}}
                            <input type="hidden" class="form-control form-control-sm" id="role_id" name="role_id" value="2">
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary ">Register</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </div>



    <script src="{{ asset('components/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/jquery-3.5.1.js"></script>
    <script src="{{ asset('components/assets') }}/js/toastr.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/script.js"></script>
  </body>
</html>
