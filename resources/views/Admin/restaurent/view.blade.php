@extends('layouts.admin');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">


        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-around align-items-center">
                        <div class="title">
                            <h4>View User Information</h4>
                        </div>
                        <a href="{{ url('admin/profile') }}" class="btn btn-dark btn-sm">
                            <i class="bi bi-person-bounding-box"></i> &nbsp; Update User Info
                        </a>
                    </div>

                    @if (Session::has('update_success'))
                        <script>
                            swal({title: "Well Done!",text: "{{ Session::get('update_success') }}",
                                icon: "success",timer: 4000
                                });
                        </script>
                    @endif
                    <div class="card-body">
                        <div class="row view_img">
                            <div class="col-sm-4 offset-sm-4 my-sm-3 d-flex align-content-center justify-content-center ">
                                @if ($data->photo != '')
                                    <img src="{{ asset('uploads/admin/'.$data->photo) }}" alt="Photo" class="img-thumbnail" height="auto">
                                @else
                                    <img src="{{ asset('components/assets/images/avarter.jpg') }}" alt="Photo" class="img-thumbnail" >
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-10 offset-1 table-responsive">
                            <table class="table table-bordered table-hover table-sm table-striped custom_view_table">
                                <tr>
                                    <td>Full Name</td>
                                    <td>:</td>
                                    <td>{{ $data->name }}</td>
                                </tr>
                                <tr>
                                    <td>E-mail Address</td>
                                    <td>:</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                @if (isset($data->phone))
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td>{{ $data->phone }}</td>
                                </tr>
                                @endif

                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge rounded-pill bg-dark">{{ $data->role->role_name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Create Time</td>
                                    <td>:</td>
                                    <td>{{ $data->created_at->format('d M Y | h:i A') }}</td>
                                </tr>
                                @if (isset($data->updated_at))
                                    <tr>
                                        <td>Updated Time</td>
                                        <td>:</td>
                                        <td>{{ $data->updated_at->format('d M Y | h:i A') }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection
