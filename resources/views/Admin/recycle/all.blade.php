@extends('layouts.admin');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">


        @if (Session::has('success'))
            <script>
                swal({title: "Well Done!",text: "{{ Session::get('success') }}",
                    icon: "success",timer: 3000
                });
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                swal({title: "Well Done!",text: "{{ Session::get('error') }}",
                    icon: "error",timer: 3000
                });
            </script>
        @endif


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Users Trashed List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="text-center">Active Status</th>
                                    <th class="text-center">Manage</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($users as $key => $data)
                                  <tr>
                                    <td>
                                        @if ($key < 9)
                                            0{{ $key+1 }}

                                        @else
                                            {{ $key+1 }}
                                        @endif
                                    </td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->role->role_name}}</td>
                                    <td class="text-center">
                                        @if ($data->status == 1)
                                        <span class="badge rounded-pill bg-success">
                                            Active
                                        </span>

                                        @else
                                        <span class="badge rounded-pill bg-danger">
                                            Deactive
                                        </span>

                                        @endif
                                    </td>

                                    {{-- @php
                                        $id = base64_encode($data->id);
                                        $url_id = urlencode($id);
                                    @endphp --}}

                                    <td class="text-center">
                                        <a href="#" id="restore" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="{{ $data->id }}" class="me-2 text-success"><i class="bi bi-arrow-repeat"></i></a>

                                        <a href="#" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $data->id }}" class="me-2 text-danger"><i class="bi bi-person-x"></i></a>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- restore modal code start -->
        <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="post" action="{{url('admin/users/restore')}}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-asterisk"></i> Confirm Message</h5>
                </div>
                <div class="modal-body modal_body">
                Are you sure to restore data ?
                <input type="hidden" name="modal_id" id="modal_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-check-circle"></i> Confirm</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                </div>
            </div>
            </form>
            </div>
        </div>

        <!-- Permanently Delete modal for user code start -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="post" action="{{url('admin/users/delete')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-asterisk"></i> Confirm Message</h5>
                    </div>
                    <div class="modal-body modal_body">
                        Are you sure to delete data permanently ?
                        <input type="hidden" name="modal_id" id="modal_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-check-circle"></i> Confirm</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Restaurant Owners Trashed List
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="restaurant" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Restaurant Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Active Status</th>
                                    <th class="text-center">Manage</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($restaurants as $key => $data)
                                  <tr>
                                    <td>
                                        @if ($key < 9)
                                            0{{ $key+1 }}

                                        @else
                                            {{ $key+1 }}
                                        @endif
                                    </td>
                                    <td>{{$data->restaurant_name}}</td>
                                    <td>{{$data->restaurant_address}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td class="text-center">
                                        @if ($data->status == 0)
                                        <span class="badge rounded-pill bg-danger">
                                            Deactive
                                        </span>

                                        @else
                                        <span class="badge rounded-pill bg-success">
                                            Active
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" id="rst_restore" data-bs-toggle="modal" data-bs-target="#rst_restoreModal" data-id="{{ $data->id }}" class="me-2 text-success"><i class="bi bi-arrow-repeat"></i></a>

                                        <a href="#" id="rst_delete" data-bs-toggle="modal" data-bs-target="#rst_deleteModal" data-id="{{ $data->id }}" class="me-2 text-danger"><i class="bi bi-person-x"></i></a>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Permanently Delete modal for restaurant code start -->
        <div class="modal fade" id="rst_DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="post" action="{{url('admin/restaurant/delete')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-asterisk"></i> Confirm Message</h5>
                    </div>
                    <div class="modal-body modal_body">
                        Are you sure to delete data permanently ?
                        <input type="hidden" name="modal_id" id="modal_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-check-circle"></i> Confirm</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                    </div>
                </div>
            </form>
            </div>
        </div>


        <!-- restore modal code for restaurant owner start -->
        <div class="modal fade" id="rst_restoreModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="post" action="{{url('admin/restaurant/restore')}}">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-asterisk"></i> Confirm Message</h5>
                </div>
                <div class="modal-body modal_body">
                Are you sure to restore data ?
                <input type="hidden" name="modal_id" id="modal_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark btn-sm"><i class="bi bi-check-circle"></i> Confirm</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                </div>
            </div>
            </form>
            </div>
        </div>



    </div>



</main>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(document).on("click", "#user_softDelete", function () {
                var deleteID = $(this).data('id');
                $(".modal_body #modal_id").val( deleteID );
        });

        $(document).on("click", "#restore", function () {
                var restoreID = $(this).data('id');
                $(".modal_body #modal_id").val( restoreID );
        });

        $(document).on("click", "#rst_restore", function () {
                var restoreID = $(this).data('id');
                $(".modal_body #modal_id").val( restoreID );
        });

        $(document).on("click", "#delete", function () {
                var deleteID = $(this).data('id');
                $(".modal_body #modal_id").val( deleteID );
        });
        $(document).on("click", "#rst_delete", function () {
                var deleteID = $(this).data('id');
                $(".modal_body #modal_id").val( deleteID );
        });
    });

</script>
@endsection
