@extends('layouts.admin');
@section('content')
<main class="mt-5 ">
    <div class="container-fluid ">


        @if (Session::has('error'))
            <script>
                swal({title: "Opps!",text: "{{ Session::get('error') }}",
                    icon: "error",timer: 2000
                    });
            </script>
        @endif

        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="form my-5 ">
                    <form method="POST" action="{{ url('/admin/profile/update') }}">
                        @csrf
                        <div class="card">

                            <div class="card-header d-flex justify-content-around align-items-lg-center">
                                <div class="title">
                                    <h4>Update My Account</h4>
                                </div>
                                <a href="{{ url('admin/profile') }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-person"></i> &nbsp; Back To Profile
                                </a>
                            </div>
                            <div class="card-body">

                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input required type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $data->name }}" placeholder="enter your name">
                                </div>

                                @error('name')
                                    <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror


                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input required type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $data->email }}" placeholder="name@example.com">
                                </div>

                                @error('email')
                                    <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input required type="password" class="form-control form-control-sm" id="current_password" name="current_password"  placeholder="current password">
                                </div>

                                @error('current_password')
                                    <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input required type="password" class="form-control form-control-sm" id="new_password" name="new_password"  placeholder="new password">
                                </div>

                                @error('new_password')
                                <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input required type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                                </div>

                                @error('password_confirmation')
                                <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="card-footer">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-dark btn-sm ">SUBMIT</button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>



    </div>
</main>

@endsection
