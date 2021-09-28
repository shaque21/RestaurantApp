@extends('layouts.restaurant');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3">

                <form method="POST" action="{{ route('category.store') }}" id="addCategoryForm" >
                    @csrf
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
                               <div class="col-md-6">Add New Category</div>
                               <div class="col-md-6 d-flex justify-content-end align-content-center ">
                                   <a href="{{ route('food.category.all') }}" class="btn btn-dark btn-sm ">
                                       <i class="bi bi-bag-fill"></i> &nbsp;
                                       All Categories
                                   </a>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control form-control-sm" id="category_name" name="category_name" value="{{ old('category_name') }}" placeholder="Enter Category Name">
                            </div>

                            @error('category_name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                            @php
                                $user_id = Auth::user()->id;
                                $restaurantId = App\Models\Restaurant::where('rstown_id',$user_id)->firstOrFail();

                            @endphp
                            <input type="hidden" name="restaurant_id" value="{{ $restaurantId->restaurant_id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-dark btn-sm ">
                                            <i class="bi bi-save"></i> &nbsp;
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
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

// Add form Validation
$(document).ready(function(){
    $('#addCategoryForm').validate({

        rules: {
            category_name: {
                required: true,
                maxlength: 100,
            },
        },
        messages: {
            category_name: {
                required: 'Please Enter Category Name',
            },
        },
        errorPlacement: function(label,element){
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        }
    });
});

    $(document).ready(function(){


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
