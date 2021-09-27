@extends('layouts.restaurant');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">



        <div class="row my-5">
            <div class="col-md-12">
                <div class="card">
                    @if (Session::has('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Opps !</strong> {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Great ! </strong>{{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header">
                       <div class="row">
                           <div class="col-md-6">All Menus</div>
                           <div class="col-md-6 d-flex justify-content-end align-content-center ">
                               <a href="{{ route('menu.add') }}" class="btn btn-dark btn-sm ">
                                   <i class="bi bi-folder-plus"></i> &nbsp;
                                   Add New Menu
                               </a>
                           </div>
                       </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="category" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="thead-dark">
                                  <tr>
                                    <th>#</th>
                                    <th>Food Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th class="text-center">Active Status</th>
                                    <th class="text-center">Manage</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($menus as $key => $data)
                                  <tr>
                                    <td>
                                        @if ($key < 9)
                                            0{{ $key+1 }}

                                        @else
                                            {{ $key+1 }}
                                        @endif
                                    </td>
                                    <td>{{$data->food_name}}</td>
                                    <td>{{$data->category->category_name}}</td>
                                    <td>{{$data->formated_description}}...</td>
                                    <td>
                                        {{ number_format($data->food_price,2) }}
                                    </td>
                                    <td>
                                        {{ number_format($data->food_discount,2) }} %
                                    </td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        <div class="form-check form-switch">
                                            {{-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked> --}}

                                            <input data-id="{{$data->id}}"
                                                class="form-check-input toggle-class"
                                                type="checkbox"
                                                data-toggle="toggle"
                                                {{ $data->food_status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('restaurant/menu/view/'.$data->food_slug)}}" class="me-2 text-primary"><i class="bi bi-eye"></i></a>
                                        <a href="{{url('restaurant/menu/edit/'.$data->food_slug)}}" class="me-2 text-success"><i class="bi bi-pencil-square"></i></a>
                                        {{-- <a href="#" id="delete" data-toggle="modal" data-target="#deleteModal" data-id="{{$data->id}}" class="text-danger">
                                            <i class="bi bi-bag-dash"></i>
                                        </a> --}}
                                        <a href="#" id="delete" data-id="{{$data->id}}" class="text-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi bi-dash-circle-fill"></i>
                                        </a>
                                    </td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="{{ route('menu.delete') }}">
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
            </div>
        </div>

    </div>





</main>

@endsection

@section('script')
<script>


    $(document).ready(function(){

        $('#category').DataTable({
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

        var route = "{!! route('menu.active') !!}";


        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: route,
                data: {'status': status, 'id': id},
                success: function(response){

                    Swal.fire(
                        'Updated!',
                        "" + response.data.message + "",
                        'success'
                    )
                }
            });
        });


        $(document).on("click", "#delete", function () {
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
