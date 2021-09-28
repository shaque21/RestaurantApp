@extends('layouts.admin');
@section('content')
<main class="mt-5 ">
    <div class="container-fluid">


        @if (Session::has('success'))
            <script>
                swal({title: "well!",text: "{{ Session::get('success') }}",
                    icon: "success",timer: 2000
                    });
            </script>
        @endif

        <div class="row cover-page"
        @if (Auth::user()->photo != '')
        style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
                url('{{ asset("uploads/admin/".Auth::user()->photo )}}')
                no-repeat center center / cover;"
        @else
        style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
                url('{{ asset("components/assets/images/avarter.jpg") }}')
                no-repeat center center / cover;"
        @endif
            >
            <div class="col-sm-4">

            </div>
            <div class="col-sm-4 my-sm-auto text-center">

                <div class="cover-text lh-lg">
                    <h2 class="text-white fw-bold">Welcome To Profile</h2>
                    <p class="text-white fw-light ps-4">Eat More And Stay With Us..</p>
                </div>
            </div>
            <div class="col-sm-4 ">

                <a href="{{ url('admin/upload-photo') }}" data-bs-toggle="tooltip" data-bs-placement="left" title="Change Photo" style="text-decoration: none">
                    <i class="bi bi-gear fw-bolder text-white fs-5 d-flex justify-content-end align-items-end pe-3 mt-3"></i>
                </a>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="main-profile">
                    <div class="avater">

                        @if ($user->photo != '')
                        <img  src="{{ asset('uploads/admin/'.$user->photo) }}" alt="Photo" width="150px">
                        @else
                        <img src="{{ asset('components/assets/images/avarter.jpg') }}" alt="Photo" width="150px">
                        @endif

                        {{-- <img src="{{ asset('components/assets/images/profile.png') }}" alt=""> --}}
                    </div>
                </div>
            </div>
            <div class="col-sm-9  d-flex justify-content-end align-items-end pe-3 mt-3">
                @if ($user->status == 1)
                <span class="badge rounded-pill bg-success">Active</span>
                @else
                <span class="badge rounded-pill bg-danger">Inactive</span>
                @endif

            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-floating my-2">
                    <input readonly type="name" class="form-control" id="name" placeholder="name@example.com" value="{{ $user->name }}">
                    <label for="name">Name</label>
                </div>
                <div class="form-floating my-2">
                    <input readonly type="name" class="form-control" id="name" placeholder="" value="{{ $user->created_at->format('Y M d | h:i:s A') }}">
                    <label for="name">Account Created At</label>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating my-2">
                    <input readonly type="name" class="form-control" id="name" placeholder="name@example.com" value="{{ $user->email }}">
                    <label for="name">Email Address</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="my-5 d-flex justify-content-center align-items-center flex-column">
                    <a href="{{ url('admin/profile/edit') }}" class="btn btn-primary custom_up_profile">update profile</a>
                </div>
            </div>
        </div>


    </div>
</main>

@endsection
