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
                        All Users
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
                                            Pending
                                        </span>

                                        @endif
                                    </td>

                                    {{-- @php
                                        $id = base64_encode($data->id);
                                        $url_id = urlencode($id);
                                    @endphp --}}

                                    <td class="text-center">
                                        <a href="{{url('admin/users/view/'.encrypt($data->id))}}" class="me-2 text-primary"><i class="bi bi-view-stacked"></i></a>
                                        <a href="{{url('admin/users/edit/'.encrypt($data->id))}}" class="me-2 text-success"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" id="user_softDelete" data-bs-toggle="modal" data-bs-target="#user_softDeleteModal" data-id="{{ $data->id }}" class="text-danger"><i class="bi bi-person-x"></i></a>
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

         <!-- softdelete modal for user code start -->
        <div class="modal fade" id="user_softDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <form method="post" action="{{url('admin/users/softdelete')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-asterisk"></i> Confirm Message</h5>
                    </div>
                    <div class="modal-body modal_body">
                        Are you want to sure delete data?
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

        $('#example').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    title: 'User Table',
                    messageTop: 'All Customers Data Here.',
                    messageBottom: 'hii',
                },
                {
                    extend: 'csv',
                    title: 'User Table',
                    messageTop: 'All Customers Data Here.',
                    messageBottom: 'hii',
                },
                {
                    extend: 'excel',
                    title: 'User Table',
                    messageTop: 'All Customers Data Here.',
                    messageBottom: 'hii',
                },
                {
                    extend: 'pdf',
                    title: 'User Table',
                    messageTop: 'All Customers Data Here.',
                    messageBottom: 'hii',
                },
                {
                    extend: 'print',
                    title: 'User Table',
                    messageTop: 'All Customers Data Here.',
                    messageBottom: 'hii',
                }

            ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');
            }
        });

        $('#restaurant').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    title: 'Restaurent Table',
                    messageTop: 'All Restaurent Owner Data Here.',
                    messageBottom: 'Footer Message',
                },
                {
                    extend: 'csv',
                    title: 'Restaurent Table',
                    messageTop: 'All Restaurent Owner Data Here.',
                    messageBottom: 'Footer Message',
                },
                {
                    extend: 'excel',
                    title: 'Restaurent Table',
                    messageTop: 'All Restaurent Owner Data Here.',
                    messageBottom: 'Footer Message',
                },
                {
                    extend: 'pdf',
                    title: 'Restaurent Table',
                    messageTop: 'All Restaurent Owner Data Here.',
                    messageBottom: 'Footer Message',
                },
                {
                    extend: 'print',
                    title: 'Restaurent Table',
                    messageTop: 'All Restaurent Owner Data Here.',
                    messageBottom: 'Footer Message',
                }

            ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');
            }
        });


        $(document).on("click", "#user_softDelete", function () {
                var deleteID = $(this).data('id');
                $(".modal_body #modal_id").val( deleteID );
        });

        $(document).on("click", "#restore", function () {
                var restoreID = $(this).data('id');
                $(".modal_body #modal_id").val( restoreID );
        });

        $(document).on("click", "#delete", function () {
                var deleteID = $(this).data('id');
                $(".modal_body #modal_id").val( deleteID );
        });
    });

</script>
@endsection
