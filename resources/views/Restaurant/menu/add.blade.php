@extends('layouts.restaurant');
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row my-5">
            <div class="col-md-6 offset-md-3">

                <form method="POST" action="{{ route('menu.store') }}" id="addMenuForm" enctype="multipart/form-data" >
                    @csrf
                    <div class="card">
                        @if (Session::has('error'))
                            <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
                                <strong>Opps !</strong> {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-info alert-dismissible fade show my-2" role="alert">
                                <strong>Great ! </strong>{{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-header">
                           <div class="row">
                               <div class="col-md-6">Add New Menu</div>
                               <div class="col-md-6 d-flex justify-content-end align-content-center ">
                                   <a href="{{ route('menu.all') }}" class="btn btn-dark btn-sm ">
                                       <i class="bi bi-menu-button-fill"></i> &nbsp;
                                       All Menu
                                   </a>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="food_name" class="form-label">Food Name</label><span class="text-danger">*</span>
                                <input type="text" class="form-control form-control-sm" id="food_name" name="food_name" value="{{ old('food_name') }}" placeholder="Enter Food Name">
                            </div>
                            @error('food_name')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <label for="category" class="form-label">Select Category</label><span class="text-danger">*</span>
                                <select class="fstdropdown-select form-control-sm" required  id="category" name="category">
                                    <option value="">Select option</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="food_price" class="form-label">Food Price</label><span class="text-danger">*</span>
                                <input type="number" class="form-control form-control-sm" id="food_price" name="food_price" value="{{ old('food_price') }}" placeholder="Enter Food Price">
                            </div>
                            @error('food_price')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror

                            <div class="mb-3">
                                <label for="food_description" class="form-label">Food Desciption</label><span class="text-danger">*</span>
                                <textarea name="food_description" class="form-control" placeholder="Enter Description" id="food_description" rows="3"></textarea>
                            </div>

                            @error('food_description')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror

                            {{-- <div class="mb-3">
                                <label for="food_discount" class="form-label">Food Price</label><span class="text-danger">*</span>
                                <input type="text" class="form-control form-control-sm" id="food_price" name="food_price" value="{{ old('food_price') }}" placeholder="Enter Food Name">
                            </div> --}}


                            <div class="mb-3">
                                <label for="food_photo" class="form-label">Photo</label><span class="text-danger">*</span>
                                <input type="file" class="form-control form-control-sm" value="{{ old('food_photo') }}" name="food_photo" onchange="previewFile(this);">
                                <img id="previewImg" class="my-2 img-thumbnail" src="{{ asset('components/assets/images/defaultFood.jpg') }}" alt="Photo" width="150px">

                                {{-- @if ($admin->photo != '')
                                <img id="previewImg" class="my-2 img-thumbnail" src="{{ asset('uploads/admin/'.$admin->photo) }}" alt="Photo" width="150px">
                                @else
                                <img id="previewImg" class="my-2 img-thumbnail" src="{{ asset('components/assets/images/avarter.jpg') }}" alt="Photo" width="150px">
                                @endif --}}

                            </div>
                            @error('food_photo')
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
    $('#addMenuForm').validate({

        rules: {
            food_name: {
                required: true,
                maxlength: 100,
            },
            category: {
                required: true,
            },
            food_description: {
                required: true,
                maxlength: 255,
            },
            food_price: {
                required: true,
            },
            food_photo: {
                required: true,
                maxlength: 100,
            },
        },
        messages: {
            category_name: {
                required: 'Please Enter Category Name',
            },
            food_name: {
                required: 'Please Enter Food Name',
            },
            category: {
                required: 'Please Select Category Name',
            },
            food_description: {
                required: 'Please Enter Food Description',
            },
            food_price: {
                required: 'Please Enter Food Price',
            },
            food_photo: {
                required: 'Please Select a Photo',
            },
        },
        errorPlacement: function(label,element){
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        }
    });
});

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
