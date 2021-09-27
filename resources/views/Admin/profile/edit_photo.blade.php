@extends('layouts.admin');
@section('content')
<main class="mt-5 ">
    <div class="container-fluid ">




        @if (Session::has('update_error'))
            <script>
                swal({text: "{{ Session::get('update_error') }}",
                    icon: "error",timer: 2000
                    });
            </script>
        @endif

        @if (Session::has('update_success'))
            <script>
                swal({title: "well!",text: "{{ Session::get('update_success') }}",
                    icon: "success",timer: 2000
                    });
            </script>
        @endif

        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="form my-5 ">
                    <form method="POST" action="{{ url('/admin/photo/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card">

                            <div class="card-header d-flex justify-content-around align-items-lg-center">
                                <div class="title">
                                    <h4>Update My Profile Picture</h4>
                                </div>
                                <a href="{{ url('admin/profile') }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-person"></i> &nbsp; Back To Profile
                                </a>
                            </div>
                            <div class="card-body">

                                <input type="hidden" name="id" value="{{ $admin->id }}">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Change Photo</label>
                                    <input type="file" class="form-control form-control-sm"  name="photo" onchange="previewFile(this);">

                                    @if ($admin->photo != '')
                                    <img id="previewImg" class="my-2 img-thumbnail" src="{{ asset('uploads/admin/'.$admin->photo) }}" alt="Photo" width="150px">
                                    @else
                                    <img id="previewImg" class="my-2 img-thumbnail" src="{{ asset('components/assets/images/avarter.jpg') }}" alt="Photo" width="150px">
                                    @endif

                                </div>

                                @error('photo')
                                    <span class="text-danger my-1 ps-1 error_msg">{{ $message }}</span>
                                @enderror


                            </div>

                            <div class="card-footer">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-dark btn-sm">SUBMIT</button>
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
@section('script')
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
