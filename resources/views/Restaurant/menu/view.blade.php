@extends('layouts.restaurant');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">


        <div class="row mt-5">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header d-flex justify-content-around align-items-center">
                        <div class="title">
                            <h4>View Food Information</h4>
                        </div>
                        <a href="{{ url('restaurant/menu/edit/'.$menu->food_slug) }}" class="btn btn-dark btn-sm">
                            <i class="bi bi-tag"></i> &nbsp; Update Menu Info
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row view_img_row">
                            <div class="col-sm-8 offset-sm-2 my-sm-3 d-flex align-content-center justify-content-center view-image ">
                                @if ($menu->food_photo != '')
                                    <img src="{{ asset('uploads/restaurant/menu/'.$menu->food_photo) }}" alt="Photo" class="img-thumbnail" height="auto">
                                @else
                                    <img src="{{ asset('components/assets/images/defaultFood.jpg') }}" alt="Photo" class="img-thumbnail" >
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-10 offset-1 table-responsive">
                            <table class="table text-center table-bordered table-hover table-sm table-striped custom_view_table">
                                <tr>
                                    <td>Food Name</td>
                                    <td>:</td>
                                    <td>{{ $menu->food_name }}</td>
                                </tr>
                                <tr>
                                    <td>Food Category</td>
                                    <td>:</td>
                                    <td>{{ $menu->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <td>Food Price</td>
                                    <td>:</td>
                                    <td>{{ number_format($menu->food_price,2) }}</td>
                                </tr>
                                <tr>
                                    <td>Food Discount</td>
                                    <td>:</td>
                                    <td>{{ number_format($menu->food_discount,2) }} %</td>
                                </tr>
                                <tr>
                                    <td>Food Status</td>
                                    <td>:</td>
                                    <td>
                                        @if($menu->food_status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Deactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Create Time</td>
                                    <td>:</td>
                                    <td>{{ $menu->created_at->format('d M Y | h:i A') }}</td>
                                </tr>
                                @if (isset($menu->updated_at))
                                    <tr>
                                        <td>Updated Time</td>
                                        <td>:</td>
                                        <td>{{ $menu->updated_at->format('d M Y | h:i A') }}</td>
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
