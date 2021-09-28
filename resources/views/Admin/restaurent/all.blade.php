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

        <div class="row my-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Restaurant Owner
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="restaurant" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Owner Name</th>
                                    <th>Restaurant Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th class="text-center">Active Status</th>
                                    <th class="text-center">Manage</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($restaurents as $key => $data)
                                  <tr>
                                    <td>
                                        @if ($key < 9)
                                            0{{ $key+1 }}

                                        @else
                                            {{ $key+1 }}
                                        @endif
                                    </td>
                                    <td>{{$data->users->name}}</td>
                                    <td>{{$data->restaurant_name}}</td>
                                    <td>{{$data->restaurant_address}}</td>
                                    <td>{{$data->users->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <div class="form-check form-switch">
                                            {{-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> --}}

                                            <input data-id="{{$data->id}}"
                                                class="form-check-input toggle-class"
                                                type="checkbox"
                                                data-toggle="toggle"
                                                {{ $data->rst_status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('admin/income/view/'.$data->id)}}" class="me-2 text-primary"><i class="bi bi-view-stacked"></i></a>
                                        <a href="{{url('admin/income/edit/'.$data->id)}}" class="me-2 text-success"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" id="softDelete" data-toggle="modal" data-target="#softDeleteModal" data-id="{{$data->id}}" class="text-danger"><i class="bi bi-person-x"></i></a>
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

    </div>



</main>

@endsection

@section('script')
<script>


    $(document).ready(function(){

        $('#restaurant').DataTable({
            responsive: true,
            // columns: [
            //     { data: '#' },
            //     { data: 'Restaurant Name' },
            //     { data: 'Address' },
            //     { data: 'Email' },
            //     { data: 'Phone' },
            // ],
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
                },

            ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');
            }
        });

        var route = "{!! route('restaurent.active') !!}";


        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: route,
                data: {'status': status, 'user_id': user_id},
                success: function(response){

                    Swal.fire(
                        'Updated!',
                        "" + response.data.message + "",
                        'success'
                    )
                }
            });
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
